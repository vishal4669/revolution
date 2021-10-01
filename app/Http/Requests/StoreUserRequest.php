<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
                'confirmed',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'fname' => [
                'string',
                'min:3',
                'max:40',
                'required',
            ],
            'lname' => [
                'string',
                'min:3',
                'max:40',
                'nullable',
            ],
            'mobile' => [
                'string',
                'min:10',
                'max:10',
                'required',
                'unique:users',
            ],
            'add_1' => [
                'string',
                'min:6',
                'max:255',
                'required',
            ],
            'add_2' => [
                'string',
                'max:255',
                'nullable',
            ],
            'city' => [
                'string',
                'min:3',
                'max:100',
                'required',
            ],
            'state' => [
                'string',
                'min:1',
                'max:100',
                'required',
            ],
            'pincode' => [
                'string',
                'required',
            ],
            'username' => [
                'string',
                'required',
                'unique:users',
            ],
        ];
    }
}
