<?php

namespace App\Http\Requests;

use App\Models\TrainerExpense;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTrainerExpenseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('trainer_expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:trainer_expenses,id',
        ];
    }
}
