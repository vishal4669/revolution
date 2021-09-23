<?php

namespace App\Http\Requests;

use App\Models\TrainerSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTrainerSettingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('trainer_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:trainer_settings,id',
        ];
    }
}
