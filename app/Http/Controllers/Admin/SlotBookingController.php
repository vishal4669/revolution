<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySlotBookingRequest;
use App\Http\Requests\StoreSlotBookingRequest;
use App\Http\Requests\UpdateSlotBookingRequest;
use App\Models\SlotBooking;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SlotBookingController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('slot_booking_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        

        if ($request->ajax()) {

            // can use the request now
            // need to add select2 box on the index page
            
            $query = SlotBooking::with(['user'])->select(sprintf('%s.*', (new SlotBooking())->table));
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'slot_booking_show';
                $editGate = 'slot_booking_edit';
                $deleteGate = 'slot_booking_delete';
                $crudRoutePart = 'slot-bookings';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->full_name : '';
            });

            $table->editColumn('hrs_used', function ($row) {
                return $row->hrs_used ? $row->hrs_used : '';
            });

            $table->addColumn('booked_time', function ($row) {
                return $row->start_time. '-' .$row->end_time;
            });

            $table->editColumn('booked_via', function ($row) {
                return $row->booked_via ? SlotBooking::BOOKED_VIA_SELECT[$row->booked_via] : SlotBooking::BOOKED_VIA_SELECT[$row->booked_via];
            });
            $table->editColumn('is_cancelled', function ($row) {
                return $row->is_cancelled ? SlotBooking::IS_CANCELLED_RADIO[$row->is_cancelled] : SlotBooking::IS_CANCELLED_RADIO[$row->is_cancelled];
            });
            $table->editColumn('cancelled_by', function ($row) {
                return $row->cancelled_by ? $row->cancelled_by : '';
            });
            $table->editColumn('remarks', function ($row) {
                return $row->remarks ? $row->remarks : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.slotBookings.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('slot_booking_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.slotBookings.create', compact('users'));
    }

    public function store(StoreSlotBookingRequest $request)
    {
        $slotBooking = SlotBooking::create($request->all());

        return redirect()->route('admin.slot-bookings.index');
    }

    public function edit(SlotBooking $slotBooking)
    {
        abort_if(Gate::denies('slot_booking_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $slotBooking->load('user');

        return view('admin.slotBookings.edit', compact('users', 'slotBooking'));
    }

    public function update(UpdateSlotBookingRequest $request, SlotBooking $slotBooking)
    {
        $slotBooking->update($request->all());

        return redirect()->route('admin.slot-bookings.index');
    }

    public function show(SlotBooking $slotBooking)
    {
        abort_if(Gate::denies('slot_booking_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slotBooking->load('user');

        return view('admin.slotBookings.show', compact('slotBooking'));
    }

    public function destroy(SlotBooking $slotBooking)
    {
        abort_if(Gate::denies('slot_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slotBooking->delete();

        return back();
    }

    public function massDestroy(MassDestroySlotBookingRequest $request)
    {
        SlotBooking::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
