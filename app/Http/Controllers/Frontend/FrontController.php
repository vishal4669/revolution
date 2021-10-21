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
                $rents = App\Models\CycleSetting::where('cycle_id', $id)->select('rent_per_day', 'rent_per_week', 'rent_per_fortnight')->first()->toArray();
            }else{
                $product = Trainer::find($id);
                $rents = App\Models\TrainerSetting::where('trainer_id', $id)->select('rent_per_day', 'rent_per_week', 'rent_per_fortnight')->first()->toArray();
            }
    
            $prodType = $prod;
            if($product->is_rented == 0){
                return view('frontend.checkout', compact('product', 'prodType', 'rents'));
            }else{
                return redirect()->route('rent-'.$prodType.'s');
            }
        }

            return view('home');
        
    }


    public function getTrainerDetails ($id='')
    {
        $trainer = Trainer::find($id);

        $relatedTrainers = Trainer::where('id', '!=', $id)->where('type', $trainer->type)->get();

        return view('frontend.trainer-detail', compact('trainer', 'relatedTrainers'));
    }

    public function myAccount ()
    {
        $user = Auth::user();

        $packages = PackageRegistration::with('package')->where('user_id', $user->id)->get();

        $cycleRentals = RentingCycle::where('user_id', $user->id)->get();

        $trainerRentals = RentingTrainer::where('user_id', $user->id)->get();
        
        $eventRegistrations = App\Models\EventRegistration::where('user_id', $user->id)->get();

        return view('frontend.myaccount', compact('user', 'packages', 'cycleRentals', 'trainerRentals', 'eventRegistrations'));
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
