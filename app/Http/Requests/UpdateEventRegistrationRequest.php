<?php

namespace App\Http\Requests;

use App\Models\EventRegistration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_registration_edit');
    }

    public function rules()
    {
        return [
            'event_id' => [
                'required',
                'integer',
            ],
            'ticket_id' => [
                'required',
                'integer',
            ],
            'payment_mode' => [
                'required',
            ],
            'transaction' => [
                'string',
                'required',
            ],
            'unique_reg_no' => [
                'string',
                'required',
                'unique:event_registrations,unique_reg_no,' . request()->route('event_registration')->id,
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}