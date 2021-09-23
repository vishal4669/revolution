<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TrainerCafeBooking;
use App\Models\MstTrainer;
use App\Models\User;
use Route;
use DateTime;
use App\Models\BlockedSlotDate;

class SlotController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
    

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
       
    }

    public function blockSlot(){
        $route_name =  Route::currentRouteName();

        return view('admin.slots.blockslots', compact('route_name'));
    }


    function storeBlockSlot(Request $request){
        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required'
        ]);

        $input = $request->all();

        $input["blocked_by_user_id"] = 2;

        $slotData = BlockedSlotDate::create($input);

        return redirect()
            ->route('admin.slots.block')
            ->with('success', 'Selected dates blocked successfully');
    }

}