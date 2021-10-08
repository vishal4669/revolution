<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRentingCycleRequest;
use App\Http\Requests\StoreRentingCycleRequest;
use App\Http\Requests\UpdateRentingCycleRequest;
use App\Models\Cycle;
use App\Models\RentingCycle;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RentingCycleController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $query = RentingCycle::with(['cycle', 'user'])->select(sprintf('%s.*', (new RentingCycle())->table));
            $table = Datatables::of($query);

            $table->addIndexColumn('');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'renting_cycle_show';
                $editGate = 'renting_cycle_edit';
                $deleteGate = 'renting_cycle_delete';
                $crudRoutePart = 'admin.renting-cycles';

                return view('admin.partials.datatablesActions', compact(
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
            $table->addColumn('cycle_name', function ($row) {
                return $row->cycle ? $row->cycle->name : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->username : '';
            });

            $table->editColumn('booking_type', function ($row) {
                return $row->booking_type ? RentingCycle::BOOKING_TYPE_RADIO[$row->booking_type] : '';
            });
            $table->editColumn('total_hours', function ($row) {
                return $row->total_hours ? $row->total_hours : '';
            });

            $table->editColumn('total_days', function ($row) {
                return $row->total_days ? $row->total_days : '';
            });
            $table->editColumn('price_per_day', function ($row) {
                return $row->price_per_day ? $row->price_per_day : '';
            });
            $table->editColumn('total_rent', function ($row) {
                return $row->total_rent ? $row->total_rent : '';
            });
            $table->editColumn('deposit_received', function ($row) {
                return $row->deposit_received ? $row->deposit_received : '';
            });
            $table->editColumn('payment_option', function ($row) {
                return $row->payment_option ? RentingCycle::PAYMENT_OPTION_RADIO[$row->payment_option] : '';
            });
            $table->editColumn('is_cancelled', function ($row) {
                if($row->is_cancelled == 0){
                    return 'No';
                }else{
                    return 'Yes';
                }
                
            });

            $table->rawColumns(['actions', 'cycle', 'user']);

            return $table->make(true);
        }

        $cycles = Cycle::get();
        $users  = User::get();

        return view('admin.rentingCycles.index', compact('cycles', 'users'));
    }

    public function create()
    {

        $cycles = Cycle::where(['is_rented' => '0', 'is_active' => '1' ])->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.rentingCycles.create', compact('cycles', 'users'));
    }

    public function store(StoreRentingCycleRequest $request)
    {
        $rentingCycle = RentingCycle::create($request->all());

        $cycle = Cycle::find($request->cycle_id);

        $cycle->is_rented = 1;

        $cycle->save();

        return redirect()->route('admin.renting-cycles.index');
    }

    public function getCycleDetails($id)
    {
       $cycle_details = Cycle::find($id);

       $rent = $cycle_details->rent_month;

       return $rent;
    }

    public function edit(RentingCycle $rentingCycle)
    {

        $cycles = Cycle::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('username', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rentingCycle->load('cycle', 'user');

        return view('admin.rentingCycles.edit', compact('cycles', 'users', 'rentingCycle'));
    }

    public function update(UpdateRentingCycleRequest $request, RentingCycle $rentingCycle)
    {
        $rentingCycle->update($request->all());

        return redirect()->route('admin.renting-cycles.index');
    }

    public function show(RentingCycle $rentingCycle)
    {

        $rentingCycle->load('cycle', 'user');

        return view('admin.rentingCycles.show', compact('rentingCycle'));
    }

    public function destroy(RentingCycle $rentingCycle)
    {

        $rentingCycle->delete();

        return back();
    }

    public function massDestroy(MassDestroyRentingCycleRequest $request)
    {
        RentingCycle::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
