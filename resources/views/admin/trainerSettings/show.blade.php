@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.trainerSetting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trainer-settings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.id') }}
                        </th>
                        <td>
                            {{ $trainerSetting->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.trainer') }}
                        </th>
                        <td>
                            {{ $trainerSetting->trainer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.rent_per_hour') }}
                        </th>
                        <td>
                            {{ $trainerSetting->rent_per_hour }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.rent_per_day') }}
                        </th>
                        <td>
                            {{ $trainerSetting->rent_per_day }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.rent_per_week') }}
                        </th>
                        <td>
                            {{ $trainerSetting->rent_per_week }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.rent_per_fortnight') }}
                        </th>
                        <td>
                            {{ $trainerSetting->rent_per_fortnight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.slot_booking_limit') }}
                        </th>
                        <td>
                            {{ $trainerSetting->slot_booking_limit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.booking_amount') }}
                        </th>
                        <td>
                            {{ $trainerSetting->booking_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.is_cafe_trainer') }}
                        </th>
                        <td>
                            {{ App\Models\TrainerSetting::IS_CAFE_TRAINER_RADIO[$trainerSetting->is_cafe_trainer] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trainer-settings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection