<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Payment;
use Session;
use Exception;
  
class RazorpayPaymentController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {        
        return view('razorpayView');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {

        //dd($request->all());
        $input = $request->all();
  
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                $razorpay = new Payment();
                $razorpay->razorpay_id = $payment->id;
                $razorpay->user_id = auth()->user()->id;
                $razorpay->amount = $payment->amount;
                $razorpay->email = $payment->email;
                $razorpay->contact = $payment->contact;
                $razorpay->status = $payment->status;
                $razorpay->description = $payment->description;
                $razorpay->method = $payment->method;
                $razorpay->created_at = $payment->created_at;
                $razorpay->save();
  
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
          
        Session::put('success', 'Payment successful');
        return redirect()->back();
    }
}