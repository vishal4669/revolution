@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.trainer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trainers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.trainer.fields.id') }}
                        </th>
                        <td>
                            {{ $trainer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainer.fields.name') }}
                        </th>
                        <td>
                            {{ $trainer->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainer.fields.photo') }}
                        </th>
                        <td>
                            @foreach($trainer->photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainer.fields.trainer_cost') }}
                        </th>
                        <td>
                            {{ $trainer->trainer_cost }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainer.fields.description') }}
                        </th>
                        <td>
                            {!! $trainer->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainer.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Trainer::TYPE_SELECT[$trainer->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainer.fields.serial_number') }}
                        </th>
                        <td>
                            {{ $trainer->serial_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainer.fields.rent_month') }}
                        </th>
                        <td>
                            {{ $trainer->rent_month }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainer.fields.rent_hour') }}
                        </th>
                        <td>
                            {{ $trainer->rent_hour }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainer.fields.is_active') }}
                        </th>
                        <td>
                            {{ App\Models\Trainer::IS_ACTIVE_RADIO[$trainer->is_active] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainer.fields.is_rented') }}
                        </th>
                        <td>
                            {{ App\Models\Trainer::IS_RENTED_RADIO[$trainer->is_rented] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trainers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection