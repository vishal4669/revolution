<?php

namespace App\Http\Requests;

use App\Models\SlotBooking;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySlotBookingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('slot_booking_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:slot_bookings,id',
        ];
    }
}
