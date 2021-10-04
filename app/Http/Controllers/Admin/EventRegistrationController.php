<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventRegistrationRequest;
use App\Http\Requests\StoreEventRegistrationRequest;
use App\Http\Requests\UpdateEventRegistrationRequest;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Ticket;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EventRegistrationController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('event_registration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EventRegistration::with(['event', 'ticket', 'user'])->select(sprintf('%s.*', (new EventRegistration())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'event_registration_show';
                $editGate = 'event_registration_edit';
                $deleteGate = 'event_registration_delete';
                $crudRoutePart = 'event-registrations';

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
            $table->addColumn('user_mobile', function ($row) {
                return $row->user ? $row->user->mobile : '';
            });
            $table->addColumn('event_name', function ($row) {
                return $row->event ? $row->event->name : '';
            });

            $table->addColumn('ticket_ticket_name', function ($row) {
                return $row->ticket ? $row->ticket->ticket_name : '';
            });

            $table->editColumn('ticket.ticket_price', function ($row) {
                return $row->ticket ? (is_string($row->ticket) ? $row->ticket : $row->ticket->ticket_price) : '';
            });
            $table->editColumn('payment_mode', function ($row) {
                return $row->payment_mode ? EventRegistration::PAYMENT_MODE_RADIO[$row->payment_mode] : '';
            });
            $table->editColumn('amount_received', function ($row) {
                return $row->amount_received ? $row->amount_received : '';
            });
            $table->editColumn('transaction', function ($row) {
                return $row->transaction ? $row->transaction : '';
            });
            $table->editColumn('unique_reg_no', function ($row) {
                return $row->unique_reg_no ? $row->unique_reg_no : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'event', 'ticket', 'user']);

            return $table->make(true);
        }

        $events  = Event::get();
        $tickets = Ticket::get();
        $users   = User::get();

        return view('admin.eventRegistrations.index', compact('events', 'tickets', 'users'));
    }

    public function create()
    {

        $events = Event::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tickets = Ticket::pluck('ticket_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::get();

        return view('admin.eventRegistrations.create', compact('users', 'events', 'tickets'));
    }

    public function store(StoreEventRegistrationRequest $request)
    {
        $eventRegistration = EventRegistration::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $eventRegistration->id]);
        }

        return redirect()->route('admin.event-registrations.index');
    }

    public function edit(EventRegistration $eventRegistration)
    {
        $events = Event::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tickets = Ticket::where('event_id', $eventRegistration->event_id)->pluck('ticket_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::get();

        $eventRegistration->load('event', 'ticket', 'user');

        return view('admin.eventRegistrations.edit', compact('events', 'tickets', 'users', 'eventRegistration'));
    }

    public function update(UpdateEventRegistrationRequest $request, EventRegistration $eventRegistration)
    {
        $eventRegistration->update($request->all());

        return redirect()->route('admin.event-registrations.index');
    }

    public function show(EventRegistration $eventRegistration)
    {

        $eventRegistration->load('event', 'ticket', 'user');

        return view('admin.eventRegistrations.show', compact('eventRegistration'));
    }

    public function destroy(EventRegistration $eventRegistration)
    {

        $eventRegistration->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventRegistrationRequest $request)
    {
        EventRegistration::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {

        $model         = new EventRegistration();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function getTickets($event_id)
    {
        if($event_id != ""){
            // $available_tickets = Ticket::first();
            // dd($available_tickets->available_tickets);
            $tickets = Ticket::where("event_id", $event_id)
            ->where("stop_booking", "=", 0)
            ->get()
            ->where("available_tickets", ">", 0);
            return response()->json($tickets);
        }
    }

    public function getTicketPrice($id)
    {
        $ticket_price = Ticket::where('id', $id)->pluck('ticket_price');
        return $ticket_price;
    }
}
