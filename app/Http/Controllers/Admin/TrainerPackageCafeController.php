<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PackageTrainerCafe;
use App\Models\MstTrainer;
use Route;

class TrainerPackageCafeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packagecafes = PackageTrainerCafe::all();
        return view('admin.packagecafes.index', compact('packagecafes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
		return view('admin.packagecafes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $input = $request->all();       

        $this->validate($request, [
	        'package_name' => 'required',
            'validity' => 'required',
            'price_per_hour' => 'required',
            'total_hours' => 'required',
            'package_tax' => 'required',
            'terms_n_conditions' => 'required',
            'total_price' => 'required'
        ]);
        
        $user = PackageTrainerCafe::create($input);
        return redirect()
            ->route('admin.packagecafes.index')
            ->with('success', 'Trainer Package Cafe created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $package = PackageTrainerCafe::find($id);
        return view('admin.packagecafes.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $route_name =  Route::currentRouteName();
        $packagecafe = PackageTrainerCafe::find($id);
        $calc_total_hours = ($packagecafe->total_hours)/60;

        return view('admin.packagecafes.edit', compact('packagecafe', 'calc_total_hours', 'route_name'));
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
            'package_name' => 'required',
            'validity' => 'required',
            'price_per_hour' => 'required',
            'total_hours' => 'required',
            'package_tax' => 'required',
            'terms_n_conditions' => 'required',
            'total_price' => 'required'
        ]);

        $input = $request->all();

        if(isset($input['total_hours']) && $input['total_hours']!=0){
            $hours = $input['total_hours'];

            $minutes = $hours * 60;
            $input['total_hours'] = $minutes;
        }

        $event = PackageTrainerCafe::find($id);
        $event->update($input);
        
        return redirect()
            ->route('admin.packagecafes.index')
            ->with('success', 'Trainer Package Cafe updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        PackageTrainerCafe::find($id)->delete();
        return redirect()
            ->route('admin.packagecafes.index')
            ->with('success', 'Trainer Package Cafe deleted successfully');
    }
}