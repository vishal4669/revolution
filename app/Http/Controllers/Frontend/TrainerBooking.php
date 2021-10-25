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
use Carbon\Carbon;

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
        

        if($user->registered_package){
            $userPackage = App\Models\PackageWallet::with('package')
            ->where('package_trainer_cafe_id', $user->registered_package->package_trainer_cafe_id)
            ->firstOrFail();
        }else{
            $userPackage = null;
        }
        

        $userBookings = TrainerCafeBooking::with('trainer')
                            ->where('users_id', $user->id)
                            ->orderBy('id', 'desc')
                            ->get();                        

        $route_name =  Route::currentRouteName();

        $slots = Slot::all();
        
        $booked_slots = SlotBooking::where('user_id', $user->id)
        ->whereDate('date', '>=', Carbon::now())
        ->orderBy('date', 'asc')
        ->get();

        // print_r($booked_slots);
        // die;

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
               

        return view('frontend.cafe_slot_booking', compact('booked_slots', 'userPackage', 'slots', 'booking_types', 'payment_types')); 
    }
    

    public function bookSlot(Request $request){
        //dd($request->all());
        $weekly_slot_id = $request->submit;

        $slots = App\Models\WeeklySlot::where('id', $weekly_slot_id)->pluck('slot_id');

        $slot_id = $slots[0];

        $booking_date = $request->booking_date;

        $userPackages = PackageTrainerCafe::where('id', auth()->user()->registered_package->package_trainer_cafe_id)->firstOrFail();

        $slot_time = Slot::where('id', $slot_id)->firstOrFail();

        $booking = new SlotBooking;
        $booking -> user_id = auth()->user()->id;
        $booking -> package_trainer_cafe_id = $userPackages->id;
        $booking -> hrs_used = 1;
        $booking -> date = $booking_date;
        $booking -> start_time = $slot_time->slot_start_time;
        $booking -> end_time = $slot_time->slot_end_time;
        $booking -> booked_via = "Website";
        $booking -> save();

        return redirect()->back()->with('success', 'Slot booked successfully!');
    }

    public function loadActiveSlots(Request $request)
    {
        if($request->date != ""){
            $date = $request->date;
            if($date == date('d-m-Y', strtotime(Carbon::now()))){
                $day_of_week = Carbon::now()->dayOfWeek;
                $daywise_slots = App\Models\WeeklySlot::with('daily_slot')
                ->where('day_of_week', $day_of_week)
                ->where('is_active', 1)
                ->get()
                ->toArray();
                return $daywise_slots;                
            }else{
                $day_of_week = Carbon::createFromFormat('d-m-Y', $request->date)->dayOfWeek;
                $daywise_slots = App\Models\WeeklySlot::with('slot')
                ->where('day_of_week', $day_of_week)
                ->where('is_active', 1)
                ->get()
                ->toArray();
                return $daywise_slots;
            }
        }
    }

}
