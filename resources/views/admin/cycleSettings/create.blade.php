@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cycleSetting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("cycle-settings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="cycle_id">{{ trans('cruds.cycleSetting.fields.cycle') }}</label>
                <select class="form-control select2 {{ $errors->has('cycle') ? 'is-invalid' : '' }}" name="cycle_id" id="cycle_id" required>
                    @foreach($cycles as $id => $entry)
                        <option value="{{ $id }}" {{ old('cycle_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('cycle'))
                    <span class="text-danger">{{ $errors->first('cycle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.cycleSetting.fields.cycle_helper') }}</span>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rent_per_hour">{{ trans('cruds.cycleSetting.fields.rent_per_hour') }}</label>
                        <input class="form-control {{ $errors->has('rent_per_hour') ? 'is-invalid' : '' }}" type="number" name="rent_per_hour" id="rent_per_hour" value="{{ old('rent_per_hour', '0') }}" step="0.01">
                        @if($errors->has('rent_per_hour'))
                            <span class="text-danger">{{ $errors->first('rent_per_hour') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.cycleSetting.fields.rent_per_hour_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rent_per_day">{{ trans('cruds.cycleSetting.fields.rent_per_day') }}</label>
                        <input class="form-control {{ $errors->has('rent_per_day') ? 'is-invalid' : '' }}" type="number" name="rent_per_day" id="rent_per_day" value="{{ old('rent_per_day', '0') }}" step="0.01">
                        @if($errors->has('rent_per_day'))
                            <span class="text-danger">{{ $errors->first('rent_per_day') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.cycleSetting.fields.rent_per_day_helper') }}</span>
                    </div>                    
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rent_per_week">{{ trans('cruds.cycleSetting.fields.rent_per_week') }}</label>
                        <input class="form-control {{ $errors->has('rent_per_week') ? 'is-invalid' : '' }}" type="number" name="rent_per_week" id="rent_per_week" value="{{ old('rent_per_week', '0') }}" step="0.01">
                        @if($errors->has('rent_per_week'))
                            <span class="text-danger">{{ $errors->first('rent_per_week') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.cycleSetting.fields.rent_per_week_helper') }}</span>
                    </div>                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="rent_per_fortnight">{{ trans('cruds.cycleSetting.fields.rent_per_fortnight') }}</label>
                        <input class="form-control {{ $errors->has('rent_per_fortnight') ? 'is-invalid' : '' }}" type="number" name="rent_per_fortnight" id="rent_per_fortnight" value="{{ old('rent_per_fortnight', '0') }}" step="0.01">
                        @if($errors->has('rent_per_fortnight'))
                            <span class="text-danger">{{ $errors->first('rent_per_fortnight') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.cycleSetting.fields.rent_per_fortnight_helper') }}</span>
                    </div>                    
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="slot_booking_limit">{{ trans('cruds.cycleSetting.fields.slot_booking_limit') }}</label>
                        <input class="form-control {{ $errors->has('slot_booking_limit') ? 'is-invalid' : '' }}" type="number" name="slot_booking_limit" id="slot_booking_limit" value="{{ old('slot_booking_limit', '0') }}" step="1">
                        @if($errors->has('slot_booking_limit'))
                            <span class="text-danger">{{ $errors->first('slot_booking_limit') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.cycleSetting.fields.slot_booking_limit_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="booking_amount">{{ trans('cruds.cycleSetting.fields.booking_amount') }}</label>
                        <input class="form-control {{ $errors->has('booking_amount') ? 'is-invalid' : '' }}" type="number" name="booking_amount" id="booking_amount" value="{{ old('booking_amount', '0') }}" step="0.01">
                        @if($errors->has('booking_amount'))
                            <span class="text-danger">{{ $errors->first('booking_amount') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.cycleSetting.fields.booking_amount_helper') }}</span>
                    </div>
                </div>
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