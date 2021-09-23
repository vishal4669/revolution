<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users,email,' . request()->route('user')->id,
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
                'unique:users,mobile,' . request()->route('user')->id,
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
                'nullable',
            ],
            'username' => [
                'string',
                'required',
            ],
        ];
    }
}
