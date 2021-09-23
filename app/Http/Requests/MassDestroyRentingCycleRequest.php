<?php

namespace App\Http\Requests;

use App\Models\RentingCycle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRentingCycleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('renting_cycle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:renting_cycles,id',
        ];
    }
}
