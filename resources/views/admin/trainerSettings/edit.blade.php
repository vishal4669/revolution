@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.trainerSetting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.trainer-settings.update", [$trainerSetting->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="trainer_id">{{ trans('cruds.trainerSetting.fields.trainer') }}</label>
                <select class="form-control select2 {{ $errors->has('trainer') ? 'is-invalid' : '' }}" name="trainer_id" id="trainer_id" required>
                    @foreach($trainers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('trainer_id') ? old('trainer_id') : $trainerSetting->trainer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('trainer'))
                    <span class="text-danger">{{ $errors->first('trainer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trainerSetting.fields.trainer_helper') }}</span>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="rent_per_hour">{{ trans('cruds.trainerSetting.fields.rent_per_hour') }}</label>
                        <input class="form-control {{ $errors->has('rent_per_hour') ? 'is-invalid' : '' }}" type="number" name="rent_per_hour" id="rent_per_hour" value="{{ old('rent_per_hour', $trainerSetting->rent_per_hour) }}" step="0.01">
                        @if($errors->has('rent_per_hour'))
                            <span class="text-danger">{{ $errors->first('rent_per_hour') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.trainerSetting.fields.rent_per_hour_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="rent_per_day">{{ trans('cruds.trainerSetting.fields.rent_per_day') }}</label>
                        <input class="form-control {{ $errors->has('rent_per_day') ? 'is-invalid' : '' }}" type="number" name="rent_per_day" id="rent_per_day" value="{{ old('rent_per_day', $trainerSetting->rent_per_day) }}" step="0.01">
                        @if($errors->has('rent_per_day'))
                            <span class="text-danger">{{ $errors->first('rent_per_day') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.trainerSetting.fields.rent_per_day_helper') }}</span>
                    </div>                    
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="rent_per_week">{{ trans('cruds.trainerSetting.fields.rent_per_week') }}</label>
                        <input class="form-control {{ $errors->has('rent_per_week') ? 'is-invalid' : '' }}" type="number" name="rent_per_week" id="rent_per_week" value="{{ old('rent_per_week', $trainerSetting->rent_per_week) }}" step="0.01">
                        @if($errors->has('rent_per_week'))
                            <span class="text-danger">{{ $errors->first('rent_per_week') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.trainerSetting.fields.rent_per_week_helper') }}</span>
                    </div>                    
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="rent_per_fortnight">{{ trans('cruds.trainerSetting.fields.rent_per_fortnight') }}</label>
                        <input class="form-control {{ $errors->has('rent_per_fortnight') ? 'is-invalid' : '' }}" type="number" name="rent_per_fortnight" id="rent_per_fortnight" value="{{ old('rent_per_fortnight', $trainerSetting->rent_per_fortnight) }}" step="0.01">
                        @if($errors->has('rent_per_fortnight'))
                            <span class="text-danger">{{ $errors->first('rent_per_fortnight') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.trainerSetting.fields.rent_per_fortnight_helper') }}</span>
                    </div>                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="slot_booking_limit">{{ trans('cruds.trainerSetting.fields.slot_booking_limit') }}</label>
                        <input class="form-control {{ $errors->has('slot_booking_limit') ? 'is-invalid' : '' }}" type="number" name="slot_booking_limit" id="slot_booking_limit" value="{{ old('slot_booking_limit', $trainerSetting->slot_booking_limit) }}" step="1">
                        @if($errors->has('slot_booking_limit'))
                            <span class="text-danger">{{ $errors->first('slot_booking_limit') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.trainerSetting.fields.slot_booking_limit_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="booking_amount">{{ trans('cruds.trainerSetting.fields.booking_amount') }}</label>
                        <input class="form-control {{ $errors->has('booking_amount') ? 'is-invalid' : '' }}" type="number" name="booking_amount" id="booking_amount" value="{{ old('booking_amount', $trainerSetting->booking_amount) }}" step="0.01">
                        @if($errors->has('booking_amount'))
                            <span class="text-danger">{{ $errors->first('booking_amount') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.trainerSetting.fields.booking_amount_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.trainerSetting.fields.is_cafe_trainer') }}</label>
                @foreach(App\Models\TrainerSetting::IS_CAFE_TRAINER_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_cafe_trainer') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_cafe_trainer_{{ $key }}" name="is_cafe_trainer" value="{{ $key }}" {{ old('is_cafe_trainer', $trainerSetting->is_cafe_trainer) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_cafe_trainer_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_cafe_trainer'))
                    <span class="text-danger">{{ $errors->first('is_cafe_trainer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trainerSetting.fields.is_cafe_trainer_helper') }}</span>
            </div>
            
            <div class="form-group">
                <label>Booking Active</label>
                @foreach(App\Models\TrainerSetting::BOOKING_ACTIVE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('booking_active') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="booking_active_{{ $key }}" name="booking_active" value="{{ $key }}" {{ old('booking_active', $trainerSetting->booking_active) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="booking_active_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('booking_active'))
                    <span class="text-danger">{{ $errors->first('booking_active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trainerSetting.fields.booking_active_helper') }}</span>
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