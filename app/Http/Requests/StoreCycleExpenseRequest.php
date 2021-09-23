<?php

namespace App\Http\Requests;

use App\Models\CycleExpense;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCycleExpenseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cycle_expense_create');
    }

    public function rules()
    {
        return [
            'repair_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'cycle_id' => [
                'required',
                'integer',
            ],
            'amount' => [
                'required',
            ],
        ];
    }
}
