<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Route;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use App\Helpers\PaymentHelper;
use DB;
use App\Helpers\Helper;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use PDF;
use App;
use Session;

class RentingController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function completeCheckout(Request $request)
    {
        
        try{
            DB::beginTransaction();
            $rentalData = array();
            $model_name = ucfirst($request->prod_type);
            $model = 'App\\Models\\'.$model_name;
            $is_rented = $model::where('id', $request->prod_id)->where('is_rented', 0)->get();
            if(count($is_rented) === 1){
                $renting_model_name = 'App\\Models\\Renting'.$model_name;
                $setting_model_name = 'App\\Models\\'.$model_name."Setting";
                $days = $request->sel_days;
                $custom_rent = $setting_model_name::where($request->prod_type.'_id', $request->prod_id)->first();
                switch($days){
                    case 1:                    
                        $rentalData["total_rent"] = $custom_rent->rent_per_day;
                        break;
                    case 7:
                        $rentalData["total_rent"] = $custom_rent->rent_per_week;
                        break;
                    case 15:
                        $rentalData["total_rent"] = $custom_rent->rent_per_fortnight;
                        break;

                    default : 
                        $rent = $model::findOrFail($request->prod_id);
                        $rentalData["total_rent"] = $rent->rent_month * ($days/30);
                        break;
                }
                $user = Auth::user();
                $user_id = $user->id;

                $rentalData["user_id"] = $user_id;
                $rentalData["booking_type"] = 1;
                $rentalData["from_date"] = $request->from_date;
                $rentalData["to_date"] = $request->to_date;
                $rentalData["total_days"] = $request->sel_days;
                $rentalData["payment_option"] = $request->payment_type;
                $rentalData["price_per_day"] = $rentalData["total_days"] / $days;
                $prod = $request->prod_type;


                //Saving Renting Data
                $rentalData[$request->prod_type."_id"] = $request->prod_id;
                $data = $renting_model_name::create($rentalData);
                //Update Cycle/Trainer status to rented.
                $product = $model::find($request->prod_id);
                $product->is_rented = 1;
                $product->save();
                $savedRentalId = $data->id;
                
                DB::commit();

                if($request->payment_type == "razorpay"){
                    return $this->processPayment($request->all(), $rentalData["total_rent"], $user, $savedRentalId);
                }else{
                    return route('frontend.order-complete', ['prod' => $prod, 'savedRentalId' => $savedRentalId ]);
                }
            }else{
                return "rented";
            }
            
        }catch(\Exception $exception){
            DB::rollback();
            return $exception->getMessage();
        }
    }

    public function processPayment($data, $rent_amount, $user, $savedRentalId)
    {
        // print_r($data);
        // die;
        $ch = curl_init();

            $fields = array();

            $rand = rand(258, 66858555);
            
            $fields["amount"] = floatval($rent_amount) * 100;
            $fields["currency"] = "INR";
            $fields["reference_id"] = $user->username.$rand;            
            $fields["description"] = "Payment for renting of (".ucfirst($data['prod_type']).")";
            $fields["accept_partial"] = false;

            $fields['notify']["sms"] = false;
            $fields['notify']["email"] = false;

            $fields['customer']["name"] = $user->fname.' '.$user->lname;
            $fields['customer']["contact"] = $user->mobile;
            $fields['customer']["email"] = $user->email;
            $fields['callback_url'] = url('order-complete/'.$data['prod_type'].'/'.$savedRentalId);
            $fields['notes']["registration_type_id"] = $savedRentalId;
            $fields['notes']["registration_type"] = "Renting";
            $fields['notes']["product"] = ucfirst($data['prod_type']);

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
                return $result_array["short_url"];

            }

            curl_close($ch);
    }
    
    public function loadInvoice (Request $request, $prod, $id)
    {        
        
        if($request->razorpay_payment_id != ""){
            
            $input = $request->all();

            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
            $payment = $api->payment->fetch($input['razorpay_payment_id']);

            PaymentHelper::save_payment($payment);

        } 
        

        if($prod == "cycle"){
            $rental = App\Models\RentingCycle::find($id);
        }else{
            $rental = App\Models\RentingTrainer::find($id);
        }

        if($rental->user_id == auth()->user()->id){
            $data['prod'] = $prod;
            $data['rental'] = $rental;
            return view('frontend.order-complete', compact('prod', 'rental'));
            //return view('frontend.invoice', compact('prod', 'rental'));            
            //dd(public_path('invoice\bootstrap.min.css'));
            // $pdf = PDF::loadView('frontend.invoice', $data);
            // return $pdf->stream('RentInv/'.ucfirst($prod).'/'.$rental->id.'.pdf');
        }else{
            return view('frontend.401');
        }
    }
}