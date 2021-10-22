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
use Carbon\Carbon;
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
            $user_package = App\Models\PackageWallet::where('user_id', auth()->user()->id)
            ->where('expiry', '>=', Carbon::now())
            ->pluck('package_trainer_cafe_id')->first();
            return view('frontend.packages', compact('packagecafes', 'user_package')); 
        }else{
            return view('frontend.packages', compact('packagecafes')); 
        }
        
    }

    public function getContactUsPage(){
        $route_name =  Route::currentRouteName();
        return view('frontend.contact', compact('route_name')); 
    }

}
