<?php

namespace App\Http\Requests;

use App\Models\Trainer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTrainerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('trainer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:trainers,id',
        ];
    }
}
