@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.eventRegistration.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-registrations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.eventRegistration.fields.id') }}
                        </th>
                        <td>
                            {{ $eventRegistration->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventRegistration.fields.name') }}
                        </th>
                        <td>
                            {{ $eventRegistration->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventRegistration.fields.event') }}
                        </th>
                        <td>
                            {{ $eventRegistration->event->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventRegistration.fields.ticket') }}
                        </th>
                        <td>
                            {{ $eventRegistration->ticket->ticket_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventRegistration.fields.payment_mode') }}
                        </th>
                        <td>
                            {{ App\Models\EventRegistration::PAYMENT_MODE_RADIO[$eventRegistration->payment_mode] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventRegistration.fields.description') }}
                        </th>
                        <td>
                            {!! $eventRegistration->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventRegistration.fields.amount_received') }}
                        </th>
                        <td>
                            {{ $eventRegistration->amount_received }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventRegistration.fields.transaction') }}
                        </th>
                        <td>
                            {{ $eventRegistration->transaction }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.eventRegistration.fields.unique_reg_no') }}
                        </th>
                        <td>
                            {{ $eventRegistration->unique_reg_no }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.event-registrations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection