@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.slotBooking.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.slot-bookings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.slotBooking.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slotBooking.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hrs_used">{{ trans('cruds.slotBooking.fields.hrs_used') }}</label>
                <input class="form-control {{ $errors->has('hrs_used') ? 'is-invalid' : '' }}" type="text" name="hrs_used" id="hrs_used" value="{{ old('hrs_used', '') }}" required>
                @if($errors->has('hrs_used'))
                    <span class="text-danger">{{ $errors->first('hrs_used') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slotBooking.fields.hrs_used_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.slotBooking.fields.date') }}</label>
                <input class="form-control datetime {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slotBooking.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.slotBooking.fields.start_time') }}</label>
                <input class="form-control {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time', '') }}" required>
                @if($errors->has('start_time'))
                    <span class="text-danger">{{ $errors->first('start_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slotBooking.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">{{ trans('cruds.slotBooking.fields.end_time') }}</label>
                <input class="form-control {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time', '') }}" required>
                @if($errors->has('end_time'))
                    <span class="text-danger">{{ $errors->first('end_time') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slotBooking.fields.end_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.slotBooking.fields.booked_via') }}</label>
                <select class="form-control {{ $errors->has('booked_via') ? 'is-invalid' : '' }}" name="booked_via" id="booked_via">
                    <option value disabled {{ old('booked_via', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\SlotBooking::BOOKED_VIA_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('booked_via', 'website') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('booked_via'))
                    <span class="text-danger">{{ $errors->first('booked_via') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slotBooking.fields.booked_via_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cancelled_by">{{ trans('cruds.slotBooking.fields.cancelled_by') }}</label>
                <input class="form-control {{ $errors->has('cancelled_by') ? 'is-invalid' : '' }}" type="text" name="cancelled_by" id="cancelled_by" value="{{ old('cancelled_by', '') }}">
                @if($errors->has('cancelled_by'))
                    <span class="text-danger">{{ $errors->first('cancelled_by') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slotBooking.fields.cancelled_by_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="remarks">{{ trans('cruds.slotBooking.fields.remarks') }}</label>
                <input class="form-control {{ $errors->has('remarks') ? 'is-invalid' : '' }}" type="text" name="remarks" id="remarks" value="{{ old('remarks', '') }}">
                @if($errors->has('remarks'))
                    <span class="text-danger">{{ $errors->first('remarks') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slotBooking.fields.remarks_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection