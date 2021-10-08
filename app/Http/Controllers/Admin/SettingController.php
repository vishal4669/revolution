<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\DateTime;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Slot;
use Route;
use Carbon\Carbon;

class SettingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$route_name =  Route::currentRouteName();
        //$settings = Setting::first();
        return view('settings.index');
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function store(Request $request)
    {
        if($request->setting_type == "slots"){
            
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