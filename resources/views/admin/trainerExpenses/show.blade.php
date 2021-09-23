@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.trainerExpense.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.admin.trainer-expenses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.trainerExpense.fields.id') }}
                        </th>
                        <td>
                            {{ $trainerExpense->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainerExpense.fields.repair_date') }}
                        </th>
                        <td>
                            {{ $trainerExpense->repair_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainerExpense.fields.trainer') }}
                        </th>
                        <td>
                            {{ $trainerExpense->trainer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainerExpense.fields.amount') }}
                        </th>
                        <td>
                            {{ $trainerExpense->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trainerExpense.fields.description') }}
                        </th>
                        <td>
                            {!! $trainerExpense->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.admin.trainer-expenses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection