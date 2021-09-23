<?php
namespace App\Http\Controllers\Admin;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PackageTrainerCafe;
use App\Models\MstTrainer;
use App\Models\User;
use Route;
use DateTime;
use App\Models\BlockedSlotDate;
use App\Models\TrainerCafeBooking;
use App\Models\TrainerRentalBooking;
use App\Models\Slot;
use Auth;
use App\Helpers\Helper;

class BookingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $route_name =  Route::currentRouteName();

        $trainers = MstTrainer::pluck('trainer_name', 'id');
        $trainers->prepend('Please Select Trainer', '');

        $frm_slots = Slot::pluck('slot_start_time', 'slot_start_time');
        $frm_slots->prepend('Please Select From Time', '');

        $to_slots = Slot::pluck('slot_end_time', 'slot_end_time');
        $to_slots->prepend('Please Select To Time', '');

        $types = array(
            '' => 'Please Select Type',
            '1' => 'Rental',
            '2' => 'Cafe'
        );

        return view('admin.bookings.index', compact('route_name', 'trainers', 'types', 'frm_slots', 'to_slots'));
    }

    /**
     * [bookSlot description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    function bookSlot(Request $request){
        $trainers = MstTrainer::pluck('trainer_name', 'id');
        $trainers->prepend('Please Select Trainer', '');

        $users = User::where('id','!=',2)->pluck('username', 'id');
        $users->prepend('Please Select User', '');

        $frm_slots = Slot::pluck('slot_start_time', 'slot_start_time');
        $frm_slots->prepend('Please Select From Time', '');

        $to_slots = Slot::pluck('slot_end_time', 'slot_end_time');
        $to_slots->prepend('Please Select To Time', '');

        $route_name =  Route::currentRouteName();
        return view('admin.frontend.cafe_slot_booking', compact('route_name', 'trainers', 'users', 'frm_slots', 'to_slots'));
    }

    function bookSlotPost(Request $request){
        $user = Auth::user();

        $this->validate($request, [
            'booking_date' => 'required',
            'booking_start_time' => 'required',
            'booking_end_time' => 'required',
        ]);

        $postData = $request->all();

        $booking_data = array();
        $booking_data['users_id'] = $user->id;
        $booking_data['booking_date'] = $postData['booking_date'];
        $booking_data["booking_start_time"] = $postData['booking_start_time'];
        $booking_data["booking_end_time"] = $postData['booking_end_time'];
        $booking_data['booking_status'] = 1;
        $booking_data['status'] = 1;
        $booking_data["booked_by_user_id"] = $user->id;

        $user = TrainerCafeBooking::create($booking_data);

        return redirect()
            ->route('admin.admin.admin.account')
            ->with('success', 'Booking created successfully, You can check your booking status bookings section');
    }

    /**
     * [rentalBookingPost use to book a rental cycle or trainer for specific dates interval]
     * @param  Request $request 
     */
    function rentalBookingPost(Request $request){
        $user = Auth::user();

        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required',
            'booking_type' => 'required',
            'payment_type' => 'required',
            'total_cost' => 'required'
        ]);

        $postData = $request->all();
        $settings = Helper::getSettings();   

        $booking_data = array();
        $booking_data['users_id'] = $user->id;
        $booking_data['price_per_day'] = $settings->price_per_day;
        $booking_data['from_date'] = $postData['from_date'];
        $booking_data['to_date'] = $postData['to_date'];
        $booking_data["payment_type"] = $postData['payment_type'];
        $booking_data["total_cost"] = $postData['total_number_of_days'] * $settings->price_per_day;
        $booking_data["total_number_of_days"] = $postData['total_number_of_days'];
        $booking_data["booking_amount"] = $settings->booking_amount;
        $booking_data["payment_details"] = $postData['payment_details'];
        $booking_data['booking_status'] = 1;
        $booking_data['status'] = 1;
        $booking_data["booked_by_user_id"] = $user->id;
        $booking_data['transaction_id'] = Helper::random_chars(8, 0, 0, 1);

        $user = TrainerRentalBooking::create($booking_data);

        return redirect()
            ->route('admin.account')
            ->with('success', 'Booking created successfully, You can check your booking status in bookings section');
    }

}