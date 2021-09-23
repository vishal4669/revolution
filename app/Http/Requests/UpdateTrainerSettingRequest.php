<?php

namespace App\Http\Requests;

use App\Models\TrainerSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTrainerSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('trainer_setting_edit');
    }

    public function rules()
    {
        return [
            'trainer_id' => [
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
