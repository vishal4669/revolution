<?php

namespace App\Http\Requests;

use App\Models\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:3',
                'max:255',
                'required',
            ],
            'last_booking_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'event_start_day' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'location' => [
                'string',
                'nullable',
            ],
            'event_type' => [
                'required',
            ],
        ];
    }
}
