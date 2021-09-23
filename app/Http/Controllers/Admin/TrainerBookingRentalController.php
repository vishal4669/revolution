<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TrainerRentalBooking;
use App\Models\MstTrainer;
use App\Models\User;
use Auth;
use Route;
use DB;
use App\Helpers\Helper;

class TrainerBookingRentalController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $transaction_id = Helper::random_chars(8, 0, 0, 1);

        $trainers = MstTrainer::pluck('trainer_name', 'id');
        $trainers->prepend('Please Select Trainer', '');

        $users = User::where('id','!=',2)->pluck('username', 'id');
        $users->prepend('Please Select User', '');

        $route_name =  Route::currentRouteName();
        $trainerbookingrentals = TrainerRentalBooking::with('trainer')->with('user')->get();

        return view('admin.trainerbookingrentals.index', compact('trainerbookingrentals','route_name','trainers', 'users', 'transaction_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $route_name =  Route::currentRouteName();
        $transaction_id = Helper::random_chars(8, 0, 0, 1);

       // print_r(Route::currentRouteName());die;
        $trainers = MstTrainer::pluck('trainer_name', 'id');
        $trainers->prepend('Please Select Trainer', '');

        $users = User::where('id','!=',2)->pluck('username', 'id');
        $users->prepend('Please Select User', '');

		return view('admin.trainerbookingrentals.create', compact('trainers', 'users', 'transaction_id','route_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'price_per_day' => 'required',
            'total_cost' => 'required',
            'total_number_of_days' => 'required'
        ]);

        $input = $request->all();
        $input["booked_by_user_id"] = auth()->user()->id;
        $input['booking_status'] = 3; // for booking started
        $input['status'] = 3;// for booking started


        $user = TrainerRentalBooking::create($input);
        return redirect()
            ->route('admin.trainerbookingrentals.index')
            ->with('success', 'Trainer Rental Booking created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $trainerbookingrental = TrainerRentalBooking::find($id);
        return view('admin.trainerbookingrentals.show', compact('trainerbookingrental'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $trainerbookingrental = TrainerRentalBooking::find($id);
        return view('admin.trainerbookingrentals.edit', compact('trainerbookingrental'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $input = $request->all();

        $main_booking_id = $request->main_booking_id;
        $input['users_id'] = $request->booking_users_id;
        unset($input['main_booking_id']);
        unset($input['booking_users_id']);
        unset($input['remaining_amount']);

        $input['booking_status'] = 3; // for booking started
        $input['status'] = 3;// for booking started
       
        $trainerbookingrental = TrainerRentalBooking::find($main_booking_id);
        $trainerbookingrental->update($input);
        
        return redirect()
            ->route('admin.trainerbookingrentals.index')
            ->with('success', 'Trainer Rental Booking started successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        TrainerRentalBooking::find($id)->delete();
        return redirect()
            ->route('admin.trainerbookingrentals.index')
            ->with('success', 'Trainer Rental Booking deleted successfully');
    }


    function getRentalBookings(Request $request){
        $users_id = $request->users_id;
        $mst_trainer_id = $request->mst_trainer_id;

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
        $totalRecords = TrainerRentalBooking::select('count(*) as allcount')->count();

        $totalRecordswithFilter = TrainerRentalBooking::select('count(*) as allcount');
        if($users_id && $users_id!=''){
            $totalRecordswithFilter->where('users_id', $users_id);
        }
        if($mst_trainer_id && $mst_trainer_id!=''){
            $totalRecordswithFilter->where('mst_trainer_id', $mst_trainer_id);
        }
        
        $totalRecordswithFilter = $totalRecordswithFilter->count();

        // Fetch records
        $records = TrainerRentalBooking::orderBy('id',$columnSortOrder);
        $records->with('trainer');
        $records->with('user');

        if($users_id && $users_id!=''){
            $records->where('users_id', $users_id);
        }
        if($mst_trainer_id && $mst_trainer_id!=''){
            $records->where('mst_trainer_id', $mst_trainer_id);
        }
        
        $records->skip($start);
        $records->take($rowperpage);
        $records = $records->get();

         $data_arr = array();
         $count = 1;
         foreach($records as $trainerbookingrental){
            $action = '';

            switch ($trainerbookingrental->booking_status) {
                case '1':
                    $action.='<div class="btn-group">
                    <a href="javascript:void(0)" class="btn btn-info" title="Start Booking" onclick="startBooking('.$trainerbookingrental->id .')" data-toggle="tooltip" data-placement="top">Start Booking</a>&nbsp;&nbsp;
                    <a href="javascript:void(0)" class="btn btn-danger" title="Delete Booking" onclick="cancelRentalBookings('.$trainerbookingrental->id .')" data-toggle="tooltip" data-placement="top">Cancel Booking</a>&nbsp;&nbsp;
                    </div>
                    ';
                    break;
                
                case '3':
                    $action.='<a href="javascript:void(0)" class="btn btn-primary" title="View Booking" onclick="viewBooking('.$trainerbookingrental->id .')" data-toggle="tooltip" data-placement="top">Booking In Progress</a>&nbsp;&nbsp;';
                    break;

                case '4':
                    $action.='Completed';
                    break;

                case '5':
                    $action.='Cancelled';
                    break;     
            }
           

           
            $data_arr[] = array(
              "no" => $count,
              "user" => (isset($trainerbookingrental->user->name)) ? $trainerbookingrental->user->name : '',
              "trainer" => (isset($trainerbookingrental->trainer->trainer_name)) ? $trainerbookingrental->trainer->trainer_name : '',
              "from_date" => date('d-M-Y',strtotime($trainerbookingrental->from_date)),
              "to_date" => date('d-M-Y',strtotime($trainerbookingrental->to_date)),
              "price_per_day" => $trainerbookingrental->price_per_day,
              "total_days" => $trainerbookingrental->total_number_of_days,
              "total_price" => $trainerbookingrental->total_cost,
              "remarks" => $trainerbookingrental->remarks,
              "action" => $action
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

    function getTrainersAsPerDate(Request $request){
        $trainers_string = '';
        //Post parameters
        $from_date = date('d-m-Y',strtotime($request->from_date));
        $to_date = date('d-m-Y',strtotime($request->to_date));
        

        $trainer_string = '<label class="required" for="payment_details">Available Trainer:</label>';
        $trainer_string .='<select name="mst_trainer_id" required id="mst_trainer_id" class="form-control">';
        $trainer_string .='<option value="">Select Trainer</option>';

        $all_trainers = MstTrainer::all();
        if(!empty($all_trainers)){
            foreach ($all_trainers as $trainer) {
               //Check for each trainer for bookings
                
                $query1 = "SELECT count(*) as count_booking FROM trainer_cafe_bookings LEFT JOIN mst_trainers ON mst_trainers.id = trainer_cafe_bookings.mst_trainer_id WHERE trainer_cafe_bookings.booking_date BETWEEN '$from_date' AND '$to_date'
                  AND booking_status NOT IN (0,1,6) 
                  AND trainer_cafe_bookings.mst_trainer_id = '$trainer->id' ";

                $cafeBookingData = DB::select($query1);

                $query2 = "SELECT count(*) as count_booking FROM trainer_rental_bookings as trb 
                LEFT JOIN mst_trainers ON mst_trainers.id = trb.mst_trainer_id 
               
                WHERE(
                  (trb.from_date <= '$from_date' AND trb.to_date >= '$to_date')
                  OR (trb.from_date >= '$from_date' AND trb.from_date <= '$to_date' AND trb.to_date <= '$to_date')
                  OR (trb.to_date <= '$to_date' AND trb.to_date >= '$from_date' AND trb.from_date <= '$from_date')
                  OR (trb.from_date >= '$from_date' AND trb.from_date <= '$to_date')
                )    

                AND trb.mst_trainer_id = '$trainer->id' AND booking_status NOT IN (0,1,6) ";

                $rentalBookingData = DB::select($query2);
                
                if(!$cafeBookingData[0]->count_booking && !$rentalBookingData[0]->count_booking){
                    $trainer_string .='<option value="'.$trainer->id.'">'.$trainer->trainer_name.'</option>';    
                }               
                
            }
        }
        
        $trainer_string .='</select>';

        echo json_encode(array('status' => 1, 'html' => $trainer_string));
        exit();

    }   

    function getRentalBookingData(Request $request){
        
        //Post parameters
        $booking_id = $request->booking_id;
        $booking_data = TrainerRentalBooking::with('trainer')->with('user')->find($booking_id);
       
        echo json_encode(array('status' => 1, 'booking_data' => $booking_data));
        exit();

    }   


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function completeBooking(Request $request)
    {
        $input = $request->all();

        $main_booking_id = $request->view_main_booking_id;
        
        $bookingData['from_date'] = $input['view_from_date'];
        $bookingData['to_date'] = $input['view_to_date'];
        $bookingData['total_number_of_days'] = $input['view_total_number_of_days'];
        //$bookingData['booking_amount'] = $input['view_booking_amount'];
        //$bookingData['price_per_day'] = $input['view_price_per_day'];
        //$bookingData['take_payment'] = $input['view_take_payment'];
        //$bookingData['total_cost'] = $input['view_total_cost'];
        $bookingData['payment_type'] = $input['view_payment_type'];
        $bookingData['payment_details'] = $input['view_payment_details'];
        $bookingData['discount'] = $input['discount'];

        $bookingData['booking_status'] = 4; // for booking started
        $bookingData['status'] = 4;// for booking started
       
        $trainerbookingrental = TrainerRentalBooking::find($main_booking_id);
        $trainerbookingrental->update($bookingData);
        
        return redirect()
            ->route('admin.trainerbookingrentals.index')
            ->with('success', 'Trainer Rental Booking completed successfully');
    }

    public function cancelRentalBookings(Request $request)
    {
        $cancel_booking_id = $request->cancel_booking_id;
        $id = (int)$cancel_booking_id;
        $trainerrentalbooking= TrainerRentalBooking::find($id);
        $trainerrentalbooking-> remarks = $request->remarks;
        $trainerrentalbooking-> booking_status = 5;
        $trainerrentalbooking->save();
        return json_encode(array('status' => $trainerrentalbooking));
    }
    
}
