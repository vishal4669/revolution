@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.slotBooking.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.slot-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.slotBooking.fields.id') }}
                        </th>
                        <td>
                            {{ $slotBooking->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slotBooking.fields.user') }}
                        </th>
                        <td>
                            {{ $slotBooking->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slotBooking.fields.hrs_used') }}
                        </th>
                        <td>
                            {{ $slotBooking->hrs_used }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slotBooking.fields.date') }}
                        </th>
                        <td>
                            {{ $slotBooking->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slotBooking.fields.start_time') }}
                        </th>
                        <td>
                            {{ $slotBooking->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slotBooking.fields.end_time') }}
                        </th>
                        <td>
                            {{ $slotBooking->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slotBooking.fields.booked_via') }}
                        </th>
                        <td>
                            {{ App\Models\SlotBooking::BOOKED_VIA_SELECT[$slotBooking->booked_via] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slotBooking.fields.is_cancelled') }}
                        </th>
                        <td>
                            {{ App\Models\SlotBooking::IS_CANCELLED_RADIO[$slotBooking->is_cancelled] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slotBooking.fields.cancelled_by') }}
                        </th>
                        <td>
                            {{ $slotBooking->cancelled_by }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slotBooking.fields.remarks') }}
                        </th>
                        <td>
                            {{ $slotBooking->remarks }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.slot-bookings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection