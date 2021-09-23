@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cycleSetting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.admin.cycle-settings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.id') }}
                        </th>
                        <td>
                            {{ $cycleSetting->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.cycle') }}
                        </th>
                        <td>
                            {{ $cycleSetting->cycle->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.rent_per_hour') }}
                        </th>
                        <td>
                            {{ $cycleSetting->rent_per_hour }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.rent_per_day') }}
                        </th>
                        <td>
                            {{ $cycleSetting->rent_per_day }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.rent_per_week') }}
                        </th>
                        <td>
                            {{ $cycleSetting->rent_per_week }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.rent_per_fortnight') }}
                        </th>
                        <td>
                            {{ $cycleSetting->rent_per_fortnight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.slot_booking_limit') }}
                        </th>
                        <td>
                            {{ $cycleSetting->slot_booking_limit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.booking_amount') }}
                        </th>
                        <td>
                            {{ $cycleSetting->booking_amount }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cycle-settings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection