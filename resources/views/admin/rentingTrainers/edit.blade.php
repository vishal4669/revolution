@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.rentingTrainer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("renting-trainers.update", [$rentingTrainer->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="trainer_id">{{ trans('cruds.rentingTrainer.fields.trainer') }}</label>
                <select class="form-control select2 {{ $errors->has('trainer') ? 'is-invalid' : '' }}" name="trainer_id" id="trainer_id" required>
                    @foreach($trainers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('trainer_id') ? old('trainer_id') : $rentingTrainer->trainer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('trainer'))
                    <span class="text-danger">{{ $errors->first('trainer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rentingTrainer.fields.trainer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.rentingTrainer.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $rentingTrainer->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rentingTrainer.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.rentingTrainer.fields.booking_type') }}</label>
                @foreach(App\Models\RentingTrainer::BOOKING_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('booking_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="booking_type_{{ $key }}" name="booking_type" value="{{ $key }}" {{ old('booking_type', $rentingTrainer->booking_type) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="booking_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('booking_type'))
                    <span class="text-danger">{{ $errors->first('booking_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rentingTrainer.fields.booking_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_hours">{{ trans('cruds.rentingTrainer.fields.total_hours') }}</label>
                <input class="form-control {{ $errors->has('total_hours') ? 'is-invalid' : '' }}" type="text" name="total_hours" id="total_hours" value="{{ old('total_hours', $rentingTrainer->total_hours) }}">
                @if($errors->has('total_hours'))
                    <span class="text-danger">{{ $errors->first('total_hours') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rentingTrainer.fields.total_hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="from_date">{{ trans('cruds.rentingTrainer.fields.from_date') }}</label>
                <input class="form-control date {{ $errors->has('from_date') ? 'is-invalid' : '' }}" type="text" name="from_date" id="from_date" value="{{ old('from_date', $rentingTrainer->from_date) }}">
                @if($errors->has('from_date'))
                    <span class="text-danger">{{ $errors->first('from_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rentingTrainer.fields.from_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="to_date">{{ trans('cruds.rentingTrainer.fields.to_date') }}</label>
                <input class="form-control date {{ $errors->has('to_date') ? 'is-invalid' : '' }}" type="text" name="to_date" id="to_date" value="{{ old('to_date', $rentingTrainer->to_date) }}">
                @if($errors->has('to_date'))
                    <span class="text-danger">{{ $errors->first('to_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rentingTrainer.fields.to_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_days">{{ trans('cruds.rentingTrainer.fields.total_days') }}</label>
                <input class="form-control {{ $errors->has('total_days') ? 'is-invalid' : '' }}" type="number" name="total_days" id="total_days" value="{{ old('total_days', $rentingTrainer->total_days) }}" step="1">
                @if($errors->has('total_days'))
                    <span class="text-danger">{{ $errors->first('total_days') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rentingTrainer.fields.total_days_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price_per_day">{{ trans('cruds.rentingTrainer.fields.price_per_day') }}</label>
                <input class="form-control {{ $errors->has('price_per_day') ? 'is-invalid' : '' }}" type="number" name="price_per_day" id="price_per_day" value="{{ old('price_per_day', $rentingTrainer->price_per_day) }}" step="1">
                @if($errors->has('price_per_day'))
                    <span class="text-danger">{{ $errors->first('price_per_day') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rentingTrainer.fields.price_per_day_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_rent">{{ trans('cruds.rentingTrainer.fields.total_rent') }}</label>
                <input class="form-control {{ $errors->has('total_rent') ? 'is-invalid' : '' }}" type="number" name="total_rent" id="total_rent" value="{{ old('total_rent', $rentingTrainer->total_rent) }}" step="0.01" required>
                @if($errors->has('total_rent'))
                    <span class="text-danger">{{ $errors->first('total_rent') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rentingTrainer.fields.total_rent_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="deposit_received">{{ trans('cruds.rentingTrainer.fields.deposit_received') }}</label>
                <input class="form-control {{ $errors->has('deposit_received') ? 'is-invalid' : '' }}" type="number" name="deposit_received" id="deposit_received" value="{{ old('deposit_received', $rentingTrainer->deposit_received) }}" step="0.01">
                @if($errors->has('deposit_received'))
                    <span class="text-danger">{{ $errors->first('deposit_received') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rentingTrainer.fields.deposit_received_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.rentingTrainer.fields.payment_option') }}</label>
                @foreach(App\Models\RentingTrainer::PAYMENT_OPTION_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('payment_option') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="payment_option_{{ $key }}" name="payment_option" value="{{ $key }}" {{ old('payment_option', $rentingTrainer->payment_option) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="payment_option_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('payment_option'))
                    <span class="text-danger">{{ $errors->first('payment_option') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rentingTrainer.fields.payment_option_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.rentingTrainer.fields.is_cancelled') }}</label>
                @foreach(App\Models\RentingTrainer::IS_CANCELLED_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_cancelled') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_cancelled_{{ $key }}" name="is_cancelled" value="{{ $key }}" {{ old('is_cancelled', $rentingTrainer->is_cancelled) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_cancelled_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_cancelled'))
                    <span class="text-danger">{{ $errors->first('is_cancelled') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rentingTrainer.fields.is_cancelled_helper') }}</span>
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