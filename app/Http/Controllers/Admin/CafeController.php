<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PackageTrainerCafe;
use Route;

class CafeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = PackageTrainerCafe::orderBy('id', 'DESC')->paginate(5);
        return view('admin.trainers.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //$roles = Role::pluck('name', 'name')->all();
        //return view('admin.users.create', compact('roles'));
		return view('admin.trainers.create');

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
	        'trainer_name' => 'required',
	        'trainer_description' => 'required',
	        'trainer_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('trainer_image')) {
            $destinationPath = 'trainer/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['trainer_image_name'] = "$profileImage";
        }

        $user = PackageTrainerCafe::create($input);
        return redirect()
            ->route('admin.trainers.index')
            ->with('success', 'Trainer created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $trainer = PackageTrainerCafe::find($id);
        return view('admin.trainers.show', compact('trainer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $trainer = PackageTrainerCafe::find($id);
        return view('admin.trainers.edit', compact('trainer'));
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
	        'trainer_name' => 'required',
	        'trainer_description' => 'required',
	        'trainer_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('trainer_image')) {
            $destinationPath = 'trainer/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['trainer_image'] = "$profileImage";
        }else{
            unset($input['trainer_image']);
        }
       
        $trainer = PackageTrainerCafe::find($id);
        $trainer->update($input);
        
        return redirect()
            ->route('admin.trainers.index')
            ->with('success', 'Trainer updated successfully');
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
            ->route('admin.trainers.index')
            ->with('success', 'User deleted successfully');
    }
}