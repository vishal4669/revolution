<?php

namespace App\Http\Requests;

use App\Models\RentingTrainer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRentingTrainerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('renting_trainer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:renting_trainers,id',
        ];
    }
}
