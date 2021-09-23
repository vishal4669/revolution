@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rentingCycle.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.renting-cycles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingCycle.fields.id') }}
                        </th>
                        <td>
                            {{ $rentingCycle->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingCycle.fields.cycle') }}
                        </th>
                        <td>
                            {{ $rentingCycle->cycle->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingCycle.fields.user') }}
                        </th>
                        <td>
                            {{ $rentingCycle->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingCycle.fields.booking_type') }}
                        </th>
                        <td>
                            {{ App\Models\RentingCycle::BOOKING_TYPE_RADIO[$rentingCycle->booking_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingCycle.fields.total_hours') }}
                        </th>
                        <td>
                            {{ $rentingCycle->total_hours }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingCycle.fields.from_date') }}
                        </th>
                        <td>
                            {{ $rentingCycle->from_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingCycle.fields.to_date') }}
                        </th>
                        <td>
                            {{ $rentingCycle->to_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingCycle.fields.total_days') }}
                        </th>
                        <td>
                            {{ $rentingCycle->total_days }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingCycle.fields.price_per_day') }}
                        </th>
                        <td>
                            {{ $rentingCycle->price_per_day }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingCycle.fields.total_rent') }}
                        </th>
                        <td>
                            {{ $rentingCycle->total_rent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingCycle.fields.deposit_received') }}
                        </th>
                        <td>
                            {{ $rentingCycle->deposit_received }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingCycle.fields.payment_option') }}
                        </th>
                        <td>
                            {{ App\Models\RentingCycle::PAYMENT_OPTION_RADIO[$rentingCycle->payment_option] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingCycle.fields.is_cancelled') }}
                        </th>
                        <td>
                            {{ App\Models\RentingCycle::IS_CANCELLED_RADIO[$rentingCycle->is_cancelled] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.renting-cycles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection