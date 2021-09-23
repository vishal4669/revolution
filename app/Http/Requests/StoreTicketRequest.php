<?php

namespace App\Http\Requests;

use App\Models\Ticket;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTicketRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ticket_create');
    }

    public function rules()
    {
        return [
            'event_id' => [
                'required',
                'integer',
            ],
            'ticket_name' => [
                'string',
                'min:3',
                'max:255',
                'required',
            ],
            'ticket_price' => [
                'required',
            ],
            'max_entries' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'booked_tickets' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'stop_booking' => [
                'required',
            ],
        ];
    }
}
