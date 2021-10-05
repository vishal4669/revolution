<?php
  
namespace App\Helpers;
  
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\EventRegistration;
use App\Models\PackageRegistration;
use Exception;
use DB;
  
class PaymentHelper 
{
    static function save_payment($payment)
    {
        try{
            DB::beginTransaction();
            if($payment->notes){
                if($payment->notes->registration_type == "Event"){
                    $ticket_id = $payment->notes->ticket_id;
                    $event_id = $payment->notes->registration_type_id;
                    $tickets = Ticket::where('id', $ticket_id)
                    ->where('event_id', $event_id)
                    ->select('booked_tickets')
                    ->firstOrFail();
                    $booked_tickets = $tickets->booked_tickets + 1;
    
                    $update_ticket_count = Ticket::find($ticket_id);
                    $update_ticket_count->booked_tickets = $booked_tickets;
                    $update_ticket_count->save();
    
                    $data = new EventRegistration();
                    $data->payment_mode = $payment->method == 'card' ? 3 : 2;
                    $data->amount_received = ($payment->amount)/100;
                    $data->transaction = $payment->id;
                    $data->event_id = $event_id;
                    $data->ticket_id = $ticket_id;
                    $data->user_id = auth()->user()->id;
                    $data->save();
    
                    PaymentHelper::add_payment($payment);
                }
                if($payment->notes->registration_type == "Package"){
                    $data = new PackageRegistration();
                    $data->payment_mode = $payment->method == 'card' ? 3 : 2;
                    $data->amount_received = ($payment->amount)/100;
                    $data->transaction = $payment->id;
                    $data->user_id = auth()->user()->id;
                    $data->save();
                    
                    PaymentHelper::add_payment($payment);
                }
            }
                
        } catch(Exception $e) {
            return  $e->getMessage();
            DB::rollBack();
        }
        DB::commit();
        
        
    }

    static function add_payment($payment)
    {
        $razorpay = new Payment();
        $razorpay->razorpay_id = $payment->id;
        $razorpay->user_id = auth()->user()->id;
        $razorpay->registration_type = $payment->notes->registration_type;
        $razorpay->registration_type_id = $payment->notes->registration_type_id;
        $razorpay->amount = $payment->amount;
        $razorpay->email = $payment->email;
        $razorpay->contact = $payment->contact;
        $razorpay->status = $payment->status;
        $razorpay->description = $payment->description;
        $razorpay->method = $payment->method;
        $razorpay->created_at = $payment->created_at;
        $razorpay->save();
    }
}