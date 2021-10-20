<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\User;
use App\Models\Trainer;
use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;
use DB;
use App\Helpers\PaymentHelper;
use PDF;
use App;

use Session;

class EventController
{
    public function loadEvents()
    {
        $events = Event::where('event_start_day', '>=', Carbon::now())->paginate(6);

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

    public function ticketsPayment(Request $request)
    {
        try{
            $ticket = App\Models\Ticket::findOrFail($request->ticket_id);
            $quantity = $request->quantity;
            $ticket_id = $request->ticket_id;
            $event_id = $ticket->event_id;
            $ticket_price = $ticket->ticket_price;
            $total_amount = $quantity * $ticket_price;
            $user = auth()->user();

            $ch = curl_init();

            $fields = array();

            $rand = rand(258, 66858555);
            
            $fields["amount"] = floatval($total_amount) * 100;
            $fields["currency"] = "INR";
            $fields["reference_id"] = $user->username.$rand;            
            $fields["description"] = "Payment for ". $quantity." ".$ticket->ticket_name." - ".$ticket->event->name." tickets";
            $fields["accept_partial"] = false;

            $fields['notify']["sms"] = false;
            $fields['notify']["email"] = false;

            $fields['customer']["name"] = $user->fname.' '.$user->lname;
            $fields['customer']["contact"] = $user->mobile;
            $fields['customer']["email"] = $user->email;
            $fields['callback_url'] = url('process-ticket-payment');
            $fields['notes']["registration_type_id"] = $event_id;
            $fields['notes']["registration_type"] = "Event";
            $fields['notes']["ticket_id"] = $ticket_id;
            $fields['notes']["quantity"] = $quantity;

            curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/payment_links');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_USERPWD, env('RAZORPAY_KEY').":".env('RAZORPAY_SECRET'));

            $headers = array();
            $headers[] = 'Accept: application/json';
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $data = curl_exec($ch);

            
            if (empty($data) OR (curl_getinfo($ch, CURLINFO_HTTP_CODE != 200))) {

               $data = false;

               return $data;
            } else {
                $result_array = json_decode($data, TRUE);                
                $url = $result_array["short_url"];
            }

            curl_close($ch);

            return \Redirect::to($url);

        }catch(\Exception $e){
            return  $e->getMessage();
        }        
            
    }

    public function processTicketPayment(Request $request)
    {
        if($request->razorpay_payment_id && $request->razorpay_payment_id != ""){

            $input = $request->all();
  
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    
            $payment = $api->payment->fetch($input['razorpay_payment_id']);

            PaymentHelper::save_payment($payment);

            return redirect()->route('allevents');

        }else{

            return redirect()->back();

        }
    }
    
}