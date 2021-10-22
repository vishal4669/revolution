<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\DateTime;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Slot;
use App\Models\WeeklySlot;
use Route;
use Carbon\Carbon;

class SettingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weekly_slots = WeeklySlot::with('slot')->get();

        return view('admin.settings.index', compact('weekly_slots'));
    }

    public function changeStatus(Request $request)
    {
       $slot_id = $request->id;
       $weekly_slot = WeeklySlot::findOrFail($slot_id);
       $weekly_slot->is_active = $weekly_slot->is_active == 0 ? 1 : 0;
       $weekly_slot->save();
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function store(Request $request)
    {
        if($request->setting_type == "slots"){

            Schema::disableForeignKeyConstraints();
            WeeklySlot::truncate();
            Slot::truncate();
            Schema::enableForeignKeyConstraints();
            
            $setting1 = new Setting();
            $setting1->setting_key = "slot_start_time";
            $setting1->setting_value = $request->time_value1;
            $setting1->save();

            $setting2 = new Setting();
            $setting2->setting_key = "slot_end_time";
            $setting2->setting_value = $request->time_value2;
            $setting2->save();    
            
            $setting3 = new Setting();
            $setting3->setting_key = "slot_interval";
            $setting3->setting_value = $request->settings_value;
            $setting3->save();

            $d1 = strtotime($request->time_value1);
            $d2 = strtotime($request->time_value2);
            $totalSecondsDiff = abs($d2-$d1);
            $totalMinutesDiff = $totalSecondsDiff/60;

            $no_of_slots = $totalMinutesDiff / intval($request->settings_value);
            $slot_start_time = Carbon::parse($request->time_value1);

            for($i=0; $i <=$no_of_slots; $i++){
                $slot = new Slot();
                $slot->slot_start_time = $slot_start_time->format('H:i');
                $end_time = $slot_start_time->addMinutes($request->settings_value);
                $slot->slot_end_time = $end_time->format('H:i');
                $slot->save();

                $slot_start_time = $end_time;
            }
            $added_slots = Slot::pluck('id');

            for($i=0; $i <=6; $i++){
                foreach($added_slots as $slot){
                    $weekly_slot = new WeeklySlot();
                    $weekly_slot->slot_id = $slot;
                    $weekly_slot->day_of_week = $i;
                    $weekly_slot->is_active = 1;
                    $weekly_slot->save();
                }
            }

            return redirect()->back();

        }
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
        $route_name =  Route::currentRouteName();

        $this->validate($request, [
	        'price_per_day' => 'required',
	        'booking_amount' => 'required', 
	        'slot_booking_limit' => 'required'
        ]);

        $input = $request->all();
        $setting = Setting::find(1);
        $setting->update($input);
        
        return redirect()
            ->route('settings')
            ->with('success', 'Settings updated successfully')
            ->with('route_name');
    }

}