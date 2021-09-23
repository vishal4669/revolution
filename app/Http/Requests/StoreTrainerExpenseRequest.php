<?php

namespace App\Http\Requests;

use App\Models\TrainerExpense;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTrainerExpenseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('trainer_expense_create');
    }

    public function rules()
    {
        return [
            'repair_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'trainer_id' => [
                'required',
                'integer',
            ],
            'amount' => [
                'required',
            ],
        ];
    }
}
