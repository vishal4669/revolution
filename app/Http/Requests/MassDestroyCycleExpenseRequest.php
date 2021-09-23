<?php

namespace App\Http\Requests;

use App\Models\CycleExpense;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCycleExpenseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cycle_expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cycle_expenses,id',
        ];
    }
}
