<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username'      => ['required', 'string', 'max:255', 'unique:users'],
            'fname'         => ['required', 'string', 'max:255'],
            'lname'         => ['string', 'max:255', 'nullable'],
            'mobile'        => ['required', 'string', 'min:10', 'max:10', 'unique:users'],
            'add_1'         => ['required', 'string', 'max:255'],
            'add_2'         => ['string', 'max:255', 'nullable'],
            'city'          => ['required', 'string', 'max:255'],
            'state'         => ['required', 'string', 'max:255'],
            'pincode'       => ['required', 'string', 'min:6', 'max:6'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'between:8,255', 'confirmed'],
        ]);
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'    => "User",
            'email'    => $data['email'],
            'fname'    => $data['fname'],
            'lname'    => $data['lname'],
            'mobile'    => $data['mobile'],
            'add_1'    => $data['add_1'],
            'add_2'    => $data['add_2'],
            'city'    => $data['city'],
            'state'    => $data['state'],
            'pincode'    => $data['pincode'],
            'username'    => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function update(Request $request)
    {
        return User::update([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
