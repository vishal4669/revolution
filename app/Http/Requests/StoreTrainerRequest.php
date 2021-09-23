<?php

namespace App\Http\Requests;

use App\Models\Trainer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTrainerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('trainer_create');
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
            'trainer_cost' => [
                'required',
            ],
            'type' => [
                'required',
            ],
            'serial_number' => [
                'string',
                'min:3',
                'max:40',
                'required',
            ],
            'rent_month' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'rent_hour' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'is_active' => [
                'required',
            ],
            'is_rented' => [
                'required',
            ],
        ];
    }
}
