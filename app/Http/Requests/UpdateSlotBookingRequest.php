<?php

namespace App\Http\Requests;

use App\Models\SlotBooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSlotBookingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('slot_booking_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'hrs_used' => [
                'string',
                'required',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'start_time' => [
                'string',
                'max:10',
                'required',
            ],
            'end_time' => [
                'string',
                'max:10',
                'required',
            ],
            'cancelled_by' => [
                'string',
                'nullable',
            ],
            'remarks' => [
                'string',
                'nullable',
            ],
        ];
    }
}
