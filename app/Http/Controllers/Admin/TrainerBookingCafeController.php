<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TrainerCafeBooking;
use App\Models\Trainer;
use App\Models\User;
use App\Models\SlotBooking;
use Route;
use DateTime;
use App\Models\BlockedSlotDate;
use DB;
use DateInterval;
use Auth;
use App\Models\UserHasPackagesCafe;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB as FacadesDB;
use Carbon\Carbon;
class TrainerBookingCafeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $trainers = Trainer::pluck('name', 'id');
        $trainers->prepend('Please Select Trainer', '');

        $users = User::where('id','!=',2)->pluck('username', 'id');
        $users->prepend('Please Select User', '');


        $route_name =  Route::currentRouteName();
        $trainerbookingcafes = TrainerCafeBooking::with('trainer')->with('user')->get();

        return view('admin.trainerbookingcafes.index', compact('trainerbookingcafes','route_name', 'trainers', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {

       $route_name =  Route::currentRouteName();

       $times = Helper::hoursRange(10, 21, 1);

       $transaction_id = Helper::random_chars(8, 0, 0, 1);

       // print_r(Route::currentRouteName());die;
        $trainers = MstTrainer::pluck('trainer_name', 'id');

        $trainers->prepend('Please Select Trainer', '');

        $users = User::where('id','!=',2)->pluck('username', 'id');
        $users->prepend('Please Select User', '');

        $frm_slots = Slot::pluck('slot_start_time', 'slot_start_time');
        $frm_slots->prepend('Please Select From Time', '');

        $to_slots = Slot::pluck('slot_end_time', 'slot_end_time');
        $to_slots->prepend('Please Select To Time', '');


		return view('admin.trainerbookingcafes.create', compact('trainers', 'users', 'times', 'transaction_id', 'route_name', 'frm_slots', 'to_slots'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

      $user = Auth::user();
      $roles = Auth::user()->roles->toArray();
      $role_names = array_column($roles, 'name');


      $input = $request->all();

      $this->validate($request, [
          'payment_type' => 'required',
          'transaction_id' => 'required',
          'mst_trainer_id' => 'required',
          'booking_date' => 'required',
          //'from_time' => 'required',
          //'to_time' => 'required'
      ]);

        $input["booked_by_user_id"] = $user->id;

        if(in_array('Admin', $role_names)){
            $input["booking_status"] = 2;
            $input["status"] = 2;
        }else{
          $input["booking_status"] = 1;
          $input["status"] = 1;
        }

        $user = TrainerCafeBooking::create($input);
        return redirect()
            ->route('admin.trainerbookingcafes.index')
            ->with('success', 'Trainer Cafe Booking created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $trainerbookingrental = TrainerCafeBooking::find($id);
        return view('admin.trainerbookingcafes.show', compact('trainerbookingrental'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $trainerbookingrental = TrainerCafeBooking::find($id);
        return view('admin.trainerbookingcafes.edit', compact('trainerbookingrental'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
	        'event_name' => 'required',
	        'event_description' => 'required',
	        'event_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        $input["booked_by_user_id"] = 2;
       
        $trainerbookingrental = TrainerCafeBooking::find($id);
        $trainerbookingrental->update($input);
        
        return redirect()
            ->route('admin.trainerbookingcafes.index')
            ->with('success', 'Trainer Cafe Booking updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //TrainerCafeBooking::find($id)->delete();
        //
        //
        $route_name =  Route::currentRouteName();
        $input["booking_status"] = 0;
       
        $trainerbookingrental = TrainerCafeBooking::find($id);
        $trainerbookingrental->update($input);

        return redirect()
            ->route('admin.trainerbookingcafes.index')
            ->with('success', 'Trainer Cafe Booking cancelled successfully')
            ->with('route_name');
    }

    function getBookingTimings(Request $request){

        $times_string = '';
        $blocked = 0;
        $selected_date = $request->booking_date;
        $selected_date_new=date('d-m-Y', strtotime($selected_date));

        $mst_trainer_id = $request->mst_trainer_id;

        $assigned_slots = array();

        $all_blocked_dates = BlockedSlotDate::all();
        foreach ($all_blocked_dates as $blockDateInfo) {
            $from_date = $blockDateInfo->from_date;
            $to_date = $blockDateInfo->to_date;
            
            $blockedDateBegin = date('d-m-Y', strtotime($from_date));
            $blockedDateEnd = date('d-m-Y', strtotime($to_date));

            if (($selected_date_new >= $blockedDateBegin) && ($selected_date_new <= $blockedDateEnd)){
                $blocked = 1;

                $times_string = '<div class="form-group col-md-12">
                          <label>Selected Date : </label>&nbsp;<strong id="label_selected_date">'.date('d-M-Y',strtotime($selected_date)).'</strong>
                          <h5 style="color:red;">Selected date is blocked, Please choose another date for booking.</h5>
                        </div>';

                echo json_encode(array('status' => 2, 'html' => $times_string));
                exit();

            }


            // selected trainer is already assigned to other user for selected
            if(isset($request->mst_trainer_id) && $request->mst_trainer_id!=''){
                    $booking_data = TrainerCafeBooking::where('booking_date', $selected_date)
                    ->where('booking_status','!=', 1)
                    ->where('booking_status','!=', 5)
                    ->where('mst_trainer_id', $request->mst_trainer_id)
                    ->get();

                        foreach ($booking_data as $booking) {
                            $booked_date = $booking->booking_slot_time;
                            $booked_slots = explode('-', $booked_date);

                            $from_time = strtotime($booked_slots[0]);
                            $to_time = strtotime($booked_slots[1]);

                            $main_time = date("H:i A", strtotime('+0 minutes', $from_time));
                            array_push($assigned_slots, $main_time);

                            while ($from_time < $to_time) {
                                
                                $after15mins = date("H:i A", strtotime('+15 minutes', $from_time));

                                array_push($assigned_slots, $after15mins);

                                // add 15 mins in current time
                                $from_time = $from_time + 900;
                            }   

                        }


                        $from_times = Helper::hoursRange(10, 20, 0.15, NULL, 1);
                        $frm_string = "<strong>From Time:</strong>";
                        $frm_string .='<select onchange="checkDates()" name="from_time" id="from_time" class="form-control">';
                        $frm_string .='<option value="">Select from time</option>';
                        foreach ($from_times as $from_t) {
                            if(in_array($from_t, $assigned_slots)){
                                $frm_string .='<option disabled="true" value="'.$from_t.'">'.$from_t.' - Booked</option>';
                            } else {
                                $frm_string .='<option value="'.$from_t.'">'.$from_t.'</option>';
                            }                            

                        }
                        $frm_string .='</select>';

                        $to_times = Helper::hoursRange(10, 21, 0.15, NULL, 1);
                        $to_string = "<strong>To Time:</strong>";
                        $to_string .='<select onchange="checkDates()"  name="to_time" id="to_time" class="form-control">';
                        $to_string .='<option value="">Select to time</option>';
                        foreach ($to_times as $to_t) {
                            if(in_array($to_t, $assigned_slots)){
                                $to_string .='<option disabled="true" value="'.$to_t.'">'.$to_t.' - Booked</option>';
                            } else {
                                $to_string .='<option value="'.$to_t.'">'.$to_t.'</option>';
                            }
                        }
                        $to_string .='</select>';

                        echo json_encode(array('status' => 0, 'html' => '', 'from_times' => $frm_string, 'to_times' => $to_string));
                        exit();


            } 
        }

        echo json_encode(array('status' => 1, 'html' => ''));
        exit();
        die;

    }

    /**
     * getBookings function to load data in the datatable
     * @param  Request $request 
     * @return json send all response in json 
     */
    function getBookings(Request $request){
        $users_id = $request->users_id;
        $mst_trainer_id = $request->mst_trainer_id;
        $booking_date = $request->booking_date;

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = SlotBooking::select('count(*) as allcount')->count();

        $totalRecordswithFilter = SlotBooking::select('count(*) as allcount');
        if($users_id && $users_id!=''){
            $totalRecordswithFilter->where('user_id', $users_id);
        }
        if($mst_trainer_id && $mst_trainer_id!=''){
            $totalRecordswithFilter->where('mst_trainer_id', $mst_trainer_id);
        }
        if($booking_date && $booking_date!=''){
            $totalRecordswithFilter->where('booking_date', $booking_date);
        }
        $totalRecordswithFilter = $totalRecordswithFilter->count();

        // Fetch records
        $records = SlotBooking::orderBy('id',$columnSortOrder);

        if($users_id && $users_id!=''){
            $records->where('user_id', $users_id);
        }
        if($mst_trainer_id && $mst_trainer_id!=''){
            $records->where('mst_trainer_id', $mst_trainer_id);
        }
        if($booking_date && $booking_date!=''){
            $records->where('booking_date', $booking_date);
        }

        $records->skip($start);
        $records->take($rowperpage);
        $records = $records->get();

         $data_arr = array();
         $count = $start+1;


         
         foreach($records as $trainerbookingcafe){
          $action = '';
            switch ($trainerbookingcafe->status) {
                case TrainerCafeBooking::PENDING:
                    $action.='<a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Booking Confirm" onclick="cancelBookingcafes(' . $trainerbookingcafe->id . ')" data-toggle="tooltip" data-placement="top">Cancel</a>&nbsp;&nbsp;';

                    $action.='<a href="javascript:void(0)" class="btn btn-sm btn-info" title="Start Timer" onclick="confirmBooking('.$trainerbookingcafe->id .')" data-toggle="tooltip" data-placement="top">Confirm</a>&nbsp;&nbsp;';                  

                    break;                
                case TrainerCafeBooking::BOOKING_CONFIRMED:
                        $action.='<a href="javascript:void(0)" id="timer_'.$trainerbookingcafe->id.'" class="btn btn-sm btn-info" title="Start Timer" onclick="startTimer(' . $trainerbookingcafe->id . ')" data-toggle="tooltip" data-placement="top">Start Timer</a>&nbsp;&nbsp;';  
                    break;                
                case TrainerCafeBooking::BOOKING_STARTED:
                       $action.='<a href="javascript:void(0)" class="btn btn-sm btn-info" title="Booking Completed" onclick="completeBooking(' . $trainerbookingcafe->id . ')" data-toggle="tooltip" data-placement="top">Complete Booking</a>&nbsp;&nbsp;';      
                    break;   
                case TrainerCafeBooking::COMPLETED:

                      if(!$trainerbookingcafe->is_performance_added){
                        $action.='<a href="javascript:void(0)" class="btn btn-sm btn-success" title="Performance" onclick="addPerformanceForBooking('.$trainerbookingcafe->id .')" data-toggle="tooltip" data-placement="top">Performance</a>&nbsp;&nbsp;';                 
                      } else {
                        $action .= '<a href="javascript:void(0)" class="btn btn-sm btn-warning" title="Summary" onclick="summary('.$trainerbookingcafe->id .')" data-toggle="tooltip" data-placement="top">Summary</a>&nbsp;&nbsp;';
                      }
   
                    break;                                         
                
                case TrainerCafeBooking::CANCELLED_BY_USER:
                        $action.='';
                    break;
                case TrainerCafeBooking::CANCELLED_BY_ADMIN:
                        $action.='<a href="javascript:void(0)" class="btn btn-sm btn-danger" title="Cancelled" data-toggle="Booking Cancelled" data-placement="top">Cancelled</a>';
                    break;
                default:
                      $status = $trainerbookingcafe->booking_status;
                    break;
            }

             
             $remaining_mins = $bk_start_datetime = $bk_end_datetime = '';
            if(isset($trainerbookingcafe->booking_slot_time)){
                $slot_times = explode('-',$trainerbookingcafe->booking_slot_time);

                $from_time = strtotime($slot_times[0]);
                $to_time = strtotime($slot_times[1]);

                $remaining_mins = round(abs($to_time - $from_time) / 60, 2);


                $bk_date = date('d-m-Y', strtotime($trainerbookingcafe->booking_date));

                $bk_start_datetime = $bk_date.' '.$slot_times[0];
                $bk_end_datetime = $bk_date.' '.$slot_times[1];

            }

           $timer = '';
           if($trainerbookingcafe->status==TrainerCafeBooking::BOOKING_STARTED){
             $timer = '<div class="timer" data-minutes-left="'.$remaining_mins.'"></div>';
           }   
           

            $data_arr[] = array(
              "no" => $count,
              "user" => $trainerbookingcafe->user->full_name,
              //"trainer" => (!empty($trainerbookingcafe->trainer) && isset($trainerbookingcafe->trainer->trainer_name)) ? $trainerbookingcafe->trainer->trainer_name : '',
              "datetime" => date('d-M-Y',strtotime($trainerbookingcafe->booking_date)).'<br>'.date('H:i A',strtotime($trainerbookingcafe->booking_start_time)).'  '.date('H:i A',strtotime($trainerbookingcafe->booking_end_time)),
              "booking_amount" => $trainerbookingcafe->booking_amount,
              "status" => $trainerbookingcafe->booking_status,
              "performance" => $trainerbookingcafe->performance,
              'timer' => '',
              'remarks' => $trainerbookingcafe->remarks,
              "action" => $action.'<input type="hidden" id="booking_date_value_'.$trainerbookingcafe->id.'" value="'.date('d-M-Y',strtotime($trainerbookingcafe->booking_date)).' '.date('H:i A',strtotime($trainerbookingcafe->booking_start_time)).'  '.date('H:i A',strtotime($trainerbookingcafe->booking_end_time)).'">'
            );

            $count++;
         }

         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordswithFilter,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
         );

         echo json_encode($response);
         exit;
  }

  /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function cancelBooking(Request $request)
    {

        $id = $request->cancel_bookingcafes_id;
        $id = (int)$id;
        $input['remarks'] = $request->remarks;
        $input["booking_status"] = TrainerCafeBooking::CANCELLED_BY_ADMIN;
        $input["status"] = TrainerCafeBooking::CANCELLED_BY_ADMIN;
        $trainerbookingrental = TrainerCafeBooking::find($id);
        $trainerbookingrental->update($input);

        return json_encode(array('status' => 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function confirmBooking(Request $request)
    {     


      try{
        $booking_id = $request->main_booking_id;
        $mst_trainer_id = $request->mst_trainer_id;

        $trainerbookingcafe = TrainerCafeBooking::find($booking_id);
        $booking_date = $trainerbookingcafe->booking_date;     

        //Fetch all packages of user
        $user = Auth::user();
        $userActivePackagesCount = UserHasPackagesCafe::where('users_id', $trainerbookingcafe->users_id)
                                ->where('expired_on', '>=',now())
                                ->orderBy('id', 'desc')
                                ->count(); 

        if($userActivePackagesCount > 0) {

            $start = strtotime($trainerbookingcafe->booking_start_time);
            $end = strtotime($trainerbookingcafe->booking_end_time);
            $diffMins = ($end - $start) / 60;
           
            $wallet_hrs = User::where('id', $trainerbookingcafe->users_id)->pluck('wallet_hrs')->first();
            $remaining_hrs = $wallet_hrs-$diffMins;

            $user = User::find($trainerbookingcafe->users_id);
            $user->wallet_hrs = $remaining_hrs;
            $user->save();

            $input["booking_status"] = TrainerCafeBooking::BOOKING_CONFIRMED;
            $input["status"] = TrainerCafeBooking::BOOKING_CONFIRMED;
            $input["mst_trainer_id"] = $mst_trainer_id;

            $trainerbookingcafe->update($input);
        } else {
          return json_encode(array('status' => 0, 'message' => "User don't have active package for booking."));
          exit();
        }
        

       } catch (Exception $e) {
          return json_encode(array('status' => 0));
          exit();
      }       
        return json_encode(array('status' => 1));
        exit();
    }

    /**
     * get timings for the specific date and trainer
     *
     * @param  int  $mst_trainer_id
     * @param  int  $booking_date
     * @return \Illuminate\Http\Response
     */

    public function getBookingTimes(Request $request)
    {     

        $booking_id = $request->main_booking_id;

        $trainerbookingcafe = TrainerCafeBooking::find($booking_id);
        $booking_date = $trainerbookingcafe->booking_date;
       
        $mst_trainer_id = $request->mst_trainer_id;

        $bookings_strings = '<div class="pad-10">';

        // check for already booking for the selected trainer for the date and time
        $bookedEntries = TrainerCafeBooking::where('booking_date', $booking_date)
                                ->where('mst_trainer_id', $mst_trainer_id)
                                ->where('mst_trainer_id', '!=', '')
                                ->get();

        $counts = count($bookedEntries);                        

        if(!empty($bookedEntries)){
            
            foreach ($bookedEntries as $booked_entry) {
                   $bookings_strings .= '<h6>'.$booked_entry->booking_slot_time.'</h6>';
            }
            
        }                          
        $bookings_strings .= '</div>';

        return json_encode(array('status' => 1, 'booked_slots' => $bookings_strings, 'count' => $counts));
        exit();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function completeBooking(Request $request)
    {

        $input["booking_status"] = TrainerCafeBooking::COMPLETED;
        $input["status"] = TrainerCafeBooking::COMPLETED;
        
        $trainerbookingrental = TrainerCafeBooking::find($request->id);
        $trainerbookingrental->update($input);

        return json_encode(array('status' => 1));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function startTimer(Request $request)
    {

        $input["booking_status"] = TrainerCafeBooking::BOOKING_STARTED;
        $input["status"] = TrainerCafeBooking::BOOKING_STARTED;
        $input["booking_start_time"] = now();
        
        $trainerbookingrental = TrainerCafeBooking::find($request->id);
        $trainerbookingrental->update($input);

        return json_encode(array('status' => 1));
    }

    /**
     * add performance for the booking
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function addPerformance(Request $request)
    {

        $input["is_performance_added"] = 1;
        $input["performance"] = $request->performance;
        
        $trainerbooking= TrainerCafeBooking::find($request->per_booking_id);
        $trainerbooking->update($input);

        return json_encode(array('status' => 1));
    }


    function checkTime(Request $request){
        $from_time = $request->from_time;
        $to_time = $request->to_time;

        $fromString = strtotime($from_time);
        $toString = strtotime($to_time);

        if($fromString  >= $toString){
            echo json_encode(array('status' => 0));
            exit();
        } else {
            echo json_encode(array('status' => 1));
            exit();
        }
    }

    function getBookingTimingsFrontend(Request $request){

        $times_string = '';
        $blocked = 0;
        $blocked_status = 0;
        $selected_date = $request->booking_date;
        $selected_date_new=date('d-m-Y', strtotime($selected_date));

        $assigned_slots = array();

        $all_blocked_dates = BlockedSlotDate::all();

        foreach ($all_blocked_dates as $blockDateInfo) {
            $from_date = $blockDateInfo->from_date;
            $to_date = $blockDateInfo->to_date;
            
            $blockedDateBegin = date('d-m-Y', strtotime($from_date));
            $blockedDateEnd = date('d-m-Y', strtotime($to_date));

            if (($selected_date_new >= $blockedDateBegin) && ($selected_date_new <= $blockedDateEnd)){
                $blocked = 1;

                $times_string = '<div class="form-group col-md-12">
                          <label>Selected Date : </label>&nbsp;<strong id="label_selected_date">'.date('d-M-Y',strtotime($selected_date)).'</strong>
                          <h5 style="color:red;">Selected date is blocked, Please choose another date for booking.</h5>
                        </div>';
                $blocked_status = 2;        
               //echo json_encode(array('status' => $blocked_status, 'html' => $times_string));
                //exit();

            }
        }

            // selected trainer is already assigned to other user for selected

            $from_times = Helper::hoursRange(10, 20, 0.25, NULL, 1);
            $frm_string = "<strong>From Time:</strong>";
            $frm_string .='<select onchange="checkDates()" name="from_time" id="from_time" class="form-control">';
            $frm_string .='<option value="">Select from time</option>';
            if($blocked_status!=2){
                foreach ($from_times as $from_t) {
                    $frm_string .='<option value="'.$from_t.'">'.$from_t.'</option>';        
                }
            }
            $frm_string .='</select>';

            $to_times = Helper::hoursRange(10, 21, 0.25, NULL, 1);
            $to_string = "<strong>To Time:</strong>";
            $to_string .='<select onchange="checkDates()"  name="to_time" id="to_time" class="form-control">';
            $to_string .='<option value="">Select to time</option>';
            if($blocked_status!=2){
                foreach ($to_times as $to_t) {               
                    $to_string .='<option value="'.$to_t.'">'.$to_t.'</option>';                
                }
            }
            $to_string .='</select>';

            echo json_encode(array('status' => $blocked_status, 'html' => $times_string, 'from_times' => $frm_string, 'to_times' => $to_string));
            exit();

    }


    function getTrainersAsPerTime(Request $request){
        $trainers_string = '';

        // check if we get the booking id
        $booking_id = (isset($request->booking_id)) ? $request->booking_id : '';
        if($booking_id && $booking_id!=''){
            $bookingRes = TrainerCafeBooking::find($booking_id);

            $booking_date = $bookingRes->booking_date;
            $booking_start_time = $bookingRes->booking_start_time;
            $booking_end_time = $bookingRes->booking_end_time;
        } else {
            //Post parameters
            $booking_date = $request->booking_date;
            $booking_start_time = $request->booking_start_time;
            $booking_end_time = $request->booking_end_time;
        }
        

        $trainer_string = "<strong>Available Trainer:</strong>";
        $trainer_string .='<select name="mst_trainer_id" required id="mst_trainer_id" class="form-control">';
        $trainer_string .='<option value="">Select Trainer</option>';


        $all_trainers = MstTrainer::all();
        if(!empty($all_trainers)){
            foreach ($all_trainers as $trainer) {
               //Check for each trainer for bookings
                
                $query = "SELECT count(*) as count_booking FROM trainer_cafe_bookings LEFT JOIN mst_trainers ON mst_trainers.id = trainer_cafe_bookings.mst_trainer_id WHERE trainer_cafe_bookings.booking_date = '$booking_date'
                  AND booking_status NOT IN (0,1,6) 
                  AND trainer_cafe_bookings.mst_trainer_id = '$trainer->id'
                  AND CAST('$booking_start_time' as time) <= trainer_cafe_bookings.booking_end_time
                  AND CAST('$booking_end_time' as time) >= trainer_cafe_bookings.booking_start_time";

                $bookingData = DB::select($query);

                $query2 = "SELECT count(*) as count_booking FROM trainer_rental_bookings as trb 
                LEFT JOIN mst_trainers ON mst_trainers.id = trb.mst_trainer_id 
               
                WHERE(
                  (trb.from_date <= '$booking_date' AND trb.to_date >= '$booking_date')
                  OR (trb.from_date >= '$booking_date' AND trb.from_date <= '$booking_date' AND trb.to_date <= '$booking_date')
                  OR (trb.to_date <= '$booking_date' AND trb.to_date >= '$booking_date' AND trb.from_date <= '$booking_date')
                  OR (trb.from_date >= '$booking_date' AND trb.from_date <= '$booking_date')
                )   
                AND trb.mst_trainer_id = '$trainer->id' AND booking_status NOT IN (0,1,6) ";

                $rentalBookingData = DB::select($query2);
                
                if(!$bookingData[0]->count_booking && !$rentalBookingData[0]->count_booking){
                    $trainer_string .='<option value="'.$trainer->id.'">'.$trainer->trainer_name.'</option>';    
                }               
                
            }
        }
        
        $trainer_string .='</select>';

        echo json_encode(array('status' => 1, 'html' => $trainer_string));
        exit();

    }

    function summary(Request $request)
    {
        $id = $request->id;
        
        $TrainerCafeBooking = FacadesDB::table('trainer_cafe_bookings')
                            ->select('trainer_cafe_bookings.id','users.name','mst_trainers.trainer_name','trainer_cafe_bookings.booking_start_time','trainer_cafe_bookings.booking_end_time','trainer_cafe_bookings.booking_amount','trainer_cafe_bookings.performance','trainer_cafe_bookings.status')
                            ->join('users','users.id','trainer_cafe_bookings.users_id')
                            ->join('mst_trainers','mst_trainers.id','trainer_cafe_bookings.mst_trainer_id')
                            ->where('trainer_cafe_bookings.id',$id)
                            ->get();
        return response($TrainerCafeBooking);
    }

}