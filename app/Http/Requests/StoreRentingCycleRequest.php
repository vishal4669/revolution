<?php

namespace App\Http\Requests;

use App\Models\RentingCycle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRentingCycleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('renting_cycle_create');
    }

    public function rules()
    {
        return [
            'cycle_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'booking_type' => [
                'required',
            ],
            'total_hours' => [
                'string',
                'nullable',
            ],
            'from_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'to_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'total_days' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'price_per_day' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'total_rent' => [
                'required',
            ],
            'payment_option' => [
                'required',
            ],
        ];
    }
}
