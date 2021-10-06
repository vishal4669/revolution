<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Route;
use Illuminate\Support\Facades\Auth;
use App\Models\PackageTrainerCafe;
use App\Models\TrainerCafeBooking;
use App\Models\Slot;
use App\Models\SlotBooking;
use DB;
use App\Helpers\Helper;
use PDF;
use App;

use Session;

class TrainerBooking
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
    public function loadTraining()
    {
        return view('frontend.training');
    }

    public function bookTrainerCafe(){
        $user = auth()->user();
        $wallet_hrs = $user->wallet_hrs;

        $wallet_seconds = $wallet_hrs * 60;

        $wallet_hrs = Helper::convert_seconds_to_time($wallet_seconds);

        $userPackages = PackageTrainerCafe::where('id', $user->registered_package->package_trainer_cafe_id)->get();
        

        $userBookings = TrainerCafeBooking::with('trainer')
                            ->where('users_id', $user->id)
                            ->orderBy('id', 'desc')
                            ->get();                        

        $route_name =  Route::currentRouteName();

        $slots = Slot::all();
        
        //$booked_slots = SlotBooking::where('user_id', $user->id)->get();

        $booking_types = [
                         '' => 'Select Booking Type',
                         '1' => 'Trainer',
                         '2' => 'Cycle'
                        ];

        $payment_types = [
                         '' => 'Select Payment Type',
                         '2' => 'Offline',
                         '4' => 'Online'
                        ];
               

        return view('frontend.cafe_slot_booking', compact('userPackages', 'wallet_hrs', 'slots', 'booking_types', 'payment_types')); 
    }
    

    public function bookSlot(Request $request){
        $slot_id = $request->submit;
        $booking_date = $request->booking_date;

        $userPackages = PackageTrainerCafe::where('id', auth()->user()->registered_package->package_trainer_cafe_id)->firstOrFail();

        $slot_time = Slot::where('id',$slot_id)->firstOrFail();

        $booking = new SlotBooking;
        $booking -> user_id = auth()->user()->id;
        $booking -> package_trainer_cafe_id = $userPackages->id;
        $booking -> hrs_used = 1;
        $booking -> date = $booking_date;
        $booking -> start_time = $slot_time->slot_start_time;
        $booking -> end_time = $slot_time->slot_end_time;
        $booking -> booked_via = "Website";
        $booking -> save();

        return redirect()->back();
    }

}
