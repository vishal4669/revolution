@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rentingTrainer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.admin.renting-trainers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingTrainer.fields.id') }}
                        </th>
                        <td>
                            {{ $rentingTrainer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingTrainer.fields.trainer') }}
                        </th>
                        <td>
                            {{ $rentingTrainer->trainer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingTrainer.fields.user') }}
                        </th>
                        <td>
                            {{ $rentingTrainer->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingTrainer.fields.booking_type') }}
                        </th>
                        <td>
                            {{ App\Models\RentingTrainer::BOOKING_TYPE_RADIO[$rentingTrainer->booking_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingTrainer.fields.total_hours') }}
                        </th>
                        <td>
                            {{ $rentingTrainer->total_hours }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingTrainer.fields.from_date') }}
                        </th>
                        <td>
                            {{ $rentingTrainer->from_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingTrainer.fields.to_date') }}
                        </th>
                        <td>
                            {{ $rentingTrainer->to_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingTrainer.fields.total_days') }}
                        </th>
                        <td>
                            {{ $rentingTrainer->total_days }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingTrainer.fields.price_per_day') }}
                        </th>
                        <td>
                            {{ $rentingTrainer->price_per_day }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingTrainer.fields.total_rent') }}
                        </th>
                        <td>
                            {{ $rentingTrainer->total_rent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingTrainer.fields.deposit_received') }}
                        </th>
                        <td>
                            {{ $rentingTrainer->deposit_received }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingTrainer.fields.payment_option') }}
                        </th>
                        <td>
                            {{ App\Models\RentingTrainer::PAYMENT_OPTION_RADIO[$rentingTrainer->payment_option] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rentingTrainer.fields.is_cancelled') }}
                        </th>
                        <td>
                            {{ App\Models\RentingTrainer::IS_CANCELLED_RADIO[$rentingTrainer->is_cancelled] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.admin.renting-trainers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection