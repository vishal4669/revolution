<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Route;
use Illuminate\Support\Facades\Auth;
use App\Models\PackageTrainerCafe;
use App\Models\UserHasPackagesCafe;
use App\Models\TrainerCafeBooking;
use App\Models\RentingCycle;
use App\Models\Payment;
use App\Models\RentingTrainer;
use App\Models\PackageRegistration;
use App\Models\User;
use App\Models\Cycle;
use App\Models\Trainer;
use App\Models\Event;
use App\Models\Testimonial;
use App\Models\Brand;
use App\Models\Slot;
use App\Models\Ticket;
use DB;
use App\Helpers\Helper;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use PDF;
use App;

use Session;

class FrontController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $route_name =  Route::currentRouteName();

        
        return redirect()
            ->route('index');

      //  return view('frontend.index',compact('route_name'));
    }

    public function homePage()
    {
        $cycles = Cycle::limit(5)->get();
        $trainers = Trainer::limit(5)->get();
        $brands = Brand::get();
        $testimonials = Testimonial::where('is_visible', '1')->get();

        return view('frontend.home',compact('cycles','trainers','brands', 'testimonials'));
    }

    public function RentCycles()
    {

        $cycles = Cycle::paginate(9);

        return view('frontend.rent-cycles',compact('cycles'));
    }

    public function RentTrainers()
    {

        $trainers = Trainer::paginate(9);

        return view('frontend.rent-trainers',compact('trainers'));
    }

    public function getCycleDetails ($id='')
    {
        $cycle = Cycle::with('comments')->find($id);

        $relatedCycles = Cycle::where('id', '!=', $id)->where('type', $cycle->type)->get();

        return view('frontend.cycle-detail', compact('cycle', 'relatedCycles'));
    }

    public function checkoutRentals ($id, $prod)
    {
        if(!empty($prod) && !empty($id)){
            if($prod == 'cycle'){
                $product = Cycle::find($id);
            }else{
                $product = Trainer::find($id);
            }
    
            $prodType = $prod;            
    
            return view('frontend.checkout', compact('product', 'prodType'));
        }

            return view('home');
        
    }

    public function completeCheckout(Request $request)
    {
        //dd($request->all());
        $user = Auth::user();
        $user_id = $user->id;

        $rentalData = array();
        $rentalData["user_id"] = $user_id;
        $rentalData["booking_type"] = 1;
        $rentalData["from_date"] = $request->from_date;
        $rentalData["to_date"] = $request->to_date;
        $rentalData["total_days"] = $request->sel_days;
        $rentalData["price_per_day"] = $request->price_per_day;
        $rentalData["total_rent"] = $request->total_rent;
        $prod = $request->prod_type;

        if($request->prod_type == "cycle"){
            $rentalData["cycle_id"] = $request->prod_id;
            $data = RentingCycle::create($rentalData);
            //update cycle status to rented.
            $cycle = Cycle::find($request->prod_id);
            $cycle->is_rented = 1;
            $cycle->save();
            $savedRentalId = $data->id;
        }else{
            $rentalData["trainer_id"] = $request->prod_id;
            $data = RentingTrainer::create($rentalData);
            //update trainer status to rented.
            $trainer = Trainer::find($request->prod_id);
            $trainer->is_rented = 1;
            $trainer->save();
            $savedRentalId = $data->id;
        }

        return redirect()->route('frontend.order-complete', compact('prod','savedRentalId'));

    }

    public function getTrainerDetails ($id='')
    {
        $trainer = Trainer::find($id);

        $relatedTrainers = Trainer::where('id', '!=', $id)->where('type', $trainer->type)->get();

        return view('frontend.trainer-detail', compact('trainer', 'relatedTrainers'));
    }

    public function loadInvoice ($prod, $id)
    {

        if($prod == "cycle"){
            $rental = RentingCycle::find($id);
        }else{
            $rental = RentingTrainer::find($id);
        }

        if($rental->user_id == auth()->user()->id){
            $data['prod'] = $prod;
            $data['rental'] = $rental;
            //return view('frontend.order-complete', compact('prod', 'rental'));
            //return view('frontend.invoice', compact('prod', 'rental'));
            
            //dd(public_path('invoice\bootstrap.min.css'));
            $pdf = PDF::loadView('frontend.invoice', $data);
            return $pdf->stream('RentInv/'.ucfirst($prod).'/'.$rental->id.'.pdf');
        }else{
            return view('frontend.401');
        }

        

        //return view('frontend.myaccount');

    }

    public function myAccount ()
    {
        $user = Auth::user();

        $packages = PackageRegistration::with('package')->where('user_id', auth()->user()->id)->get();

        return view('frontend.myaccount', compact('user', 'packages'));
    }

    public function loadContact ()
    {
        return view('frontend.contact');
    }

    public function loadTraining(){
        return view('frontend.training');
    }

    public function getPackagesPage(){
        $packagecafes = PackageTrainerCafe::get();
        if(auth()->check()){
            $user_package = Payment::where('user_id', auth()->user()->id)->pluck('description')->first();
            return view('frontend.packages', compact('packagecafes', 'user_package')); 
        }else{
            return view('frontend.packages', compact('packagecafes')); 
        }
        
    }

    public function getContactUsPage(){
        $route_name =  Route::currentRouteName();
        return view('frontend.contact', compact('route_name')); 
    }

    public function bookPackage(Request $request){
        $user = Auth::user();
        $user_id = $user->id;

        $package_data = PackageTrainerCafe::find($request->id);

        $created_on = date('d-m-Y');
        $expired_on = date('d-m-Y', strtotime($created_on. ' + '.$package_data->validity.' days'));

        $packageData = array();
        $packageData["users_id"] = $user_id;
        $packageData["package_trainer_cafes_id"] = $request->id;
        $packageData["validity"] = $package_data->validity;
        $packageData["total_price"] = $package_data->total_price;
        $packageData["expired_on"] = $expired_on;
        UserHasPackagesCafe::create($packageData);
        
        $user = User::find($user_id);

        $userData = array();
        $userData['wallet_hrs'] = $user->wallet_hrs + $package_data->total_hours;        
        $user->update($userData);

        return redirect()
            ->route('package')
            ->with('success', 'Package booked successfully');

    }

}
