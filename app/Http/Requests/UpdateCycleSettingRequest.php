<?php

namespace App\Http\Requests;

use App\Models\CycleSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCycleSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cycle_setting_edit');
    }

    public function rules()
    {
        return [
            'cycle_id' => [
                'required',
                'integer',
            ],
            'slot_booking_limit' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
