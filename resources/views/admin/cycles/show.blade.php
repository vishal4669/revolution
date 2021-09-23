@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cycle.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cycles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cycle.fields.id') }}
                        </th>
                        <td>
                            {{ $cycle->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycle.fields.name') }}
                        </th>
                        <td>
                            {{ $cycle->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycle.fields.photo') }}
                        </th>
                        <td>
                            @foreach($cycle->photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycle.fields.cycle_cost') }}
                        </th>
                        <td>
                            {{ $cycle->cycle_cost }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycle.fields.description') }}
                        </th>
                        <td>
                            {!! $cycle->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycle.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Cycle::TYPE_SELECT[$cycle->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycle.fields.serial_number') }}
                        </th>
                        <td>
                            {{ $cycle->serial_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycle.fields.rent_month') }}
                        </th>
                        <td>
                            {{ $cycle->rent_month }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycle.fields.rent_hour') }}
                        </th>
                        <td>
                            {{ $cycle->rent_hour }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycle.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Cycle::IS_ACTIVE_RADIO[$cycle->is_active] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cycle.fields.is_rented') }}
                        </th>
                        <td>
                            {{ App\Models\Cycle::IS_RENTED_RADIO[$cycle->is_rented] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cycles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection