<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\User;
use App\Models\Trainer;
use App\Models\Event;
use App\Models\Ticket;
use DB;
use App\Helpers\Helper;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use PDF;
use App;

use Session;

class EventController
{
    public function loadEvents()
    {
        $events = Event::all();

        return view('frontend.events', compact('events'));
    }

    public function loadEventInfo($id)
    {
        if($id != null){
            $event_info = Event::where('id', $id)->firstOrFail();
            $upcoming_events = Event::where('id','<>', $id)->limit(3)->get();
            $tickets = Ticket::where('event_id', $id)
                        ->where('stop_booking', 0)
                        ->get()
                        ->where('available_tickets', '>', 0);
            if(auth()->check()){
                $is_registered = Payment::where('registration_type_id', $id)
                                ->where('registration_type', "Event")
                                ->where('user_id', auth()->user()->id)
                                ->get();
                                return view('frontend.event-info', compact('event_info', 'upcoming_events', 'tickets', 'is_registered'));
            }
            
        }

        return view('frontend.event-info', compact('event_info', 'upcoming_events', 'tickets'));
    }
    
}