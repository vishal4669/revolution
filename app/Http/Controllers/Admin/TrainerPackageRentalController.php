<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PackageTrainerRental;
use App\Models\MstTrainer;
use App\Models\User;
use Route;

class TrainerPackageRentalController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $route_name =  Route::currentRouteName();
        $packagerentals = PackageTrainerRental::with('trainer')->get();
        return view('admin.packagerentals.index', compact('packagerentals','route_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $route_name =  Route::currentRouteName();
        $trainers = MstTrainer::pluck('trainer_name', 'id');
        $trainers->prepend('Please Select Trainer', '');

        $users = User::where('id','!=',2)->pluck('username', 'id');
        $users->prepend('Please Select User', '');

		return view('admin.packagerentals.create', compact('trainers', 'users','route_name'));
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
            'mst_trainer_id' => 'required',
            'price_per_day' => 'required',
            'total_number_of_days' => 'required',            
            'terms_n_conditions' => 'required',
            'total_price' => 'required'
        ]);
        
        $user = PackageTrainerRental::create($input);
        return redirect()
            ->route('admin.packagerentals.index')
            ->with('success', 'Trainer Package Rental created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $packagerentals = PackageTrainerRental::find($id);
        return view('admin.packagerentals.show', compact('packagerentals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $users = User::where('id','!=',2)->pluck('username', 'id');
        $users->prepend('Please Select User', '');

        $trainers = MstTrainer::pluck('trainer_name', 'id');
        $trainers->prepend('Please Select Trainer', '');

        $packagerentals = PackageTrainerRental::find($id);
        return view('admin.packagerentals.edit', compact('packagerentals','users','trainers'));
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
            'mst_trainer_id' => 'required',
            'price_per_day' => 'required',
            'total_number_of_days' => 'required',
            'terms_n_conditions' => 'required',
            'total_price' => 'required'
        ]);

        $input = $request->all();  
       
        $packagerentals = PackageTrainerRental::find($id);
        $packagerentals->update($input);
        
        return redirect()
            ->route('admin.packagerentals.index')
            ->with('success', 'Trainer Package Rental updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        PackageTrainerRental::find($id)->delete();
        return redirect()
            ->route('admin.packagerentals.index')
            ->with('success', 'Trainer Package Rental deleted successfully');
    }
}