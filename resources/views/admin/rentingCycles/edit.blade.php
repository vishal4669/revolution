@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.rentingCycle.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("renting-cycles.update", [$rentingCycle->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="cycle_id">{{ trans('cruds.rentingCycle.fields.cycle') }}</label>
                        <select class="form-control select2 {{ $errors->has('cycle') ? 'is-invalid' : '' }}" name="cycle_id" id="cycle_id" required>
                            @foreach($cycles as $id => $entry)
                                <option value="{{ $id }}" {{ (old('cycle_id') ? old('cycle_id') : $rentingCycle->cycle->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('cycle'))
                            <span class="text-danger">{{ $errors->first('cycle') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.rentingCycle.fields.cycle_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="user_id">{{ trans('cruds.rentingCycle.fields.user') }}</label>
                        <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                            @foreach($users as $id => $entry)
                                <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $rentingCycle->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('user'))
                            <span class="text-danger">{{ $errors->first('user') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.rentingCycle.fields.user_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required">{{ trans('cruds.rentingCycle.fields.booking_type') }}</label>
                        @foreach(App\Models\RentingCycle::BOOKING_TYPE_RADIO as $key => $label)
                            <div class="form-check {{ $errors->has('booking_type') ? 'is-invalid' : '' }}">
                                <input class="form-check-input" type="radio" id="booking_type_{{ $key }}" name="booking_type" value="{{ $key }}" {{ old('booking_type', $rentingCycle->booking_type) === (string) $key ? 'checked' : '' }} required>
                                <label class="form-check-label" for="booking_type_{{ $key }}">{{ $label }}</label>
                            </div>
                        @endforeach
                        @if($errors->has('booking_type'))
                            <span class="text-danger">{{ $errors->first('booking_type') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.rentingCycle.fields.booking_type_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-4" id="total_hours_div" style="display:none;">
                    <div class="form-group">
                        <label for="total_hours">{{ trans('cruds.rentingCycle.fields.total_hours') }}</label>
                        <input class="form-control {{ $errors->has('total_hours') ? 'is-invalid' : '' }}" type="text" name="total_hours" id="total_hours" value="{{ old('total_hours', $rentingCycle->total_hours) }}">
                        @if($errors->has('total_hours'))
                            <span class="text-danger">{{ $errors->first('total_hours') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.rentingCycle.fields.total_hours_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-4" id="sel_months_div">
                    <div class="form-group">
                        <label for="sel_months">How many months?</label>
                        <input class="form-control {{ $errors->has('sel_months') ? 'is-invalid' : '' }}" onkeyup="upd_months()" type="number"
                            name="sel_months" id="sel_months" value="{{ old('sel_months', '1') }}"="1">
                        @if($errors->has('sel_months'))
                        <span class="text-danger">Please enter months as numeric value. eg: 1 or 2 or 3</span>
                        @endif
                        <span class="help-block">Enter number of months you want to rent.</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="from_date">{{ trans('cruds.rentingCycle.fields.from_date') }}</label>
                        <input class="form-control date {{ $errors->has('from_date') ? 'is-invalid' : '' }}" type="text" name="from_date" id="from_date" value="{{ old('from_date', $rentingCycle->from_date) }}">
                        @if($errors->has('from_date'))
                            <span class="text-danger">{{ $errors->first('from_date') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.rentingCycle.fields.from_date_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="to_date">{{ trans('cruds.rentingCycle.fields.to_date') }}</label>
                        <input class="form-control date {{ $errors->has('to_date') ? 'is-invalid' : '' }}" readonly type="text" name="to_date" id="to_date" value="{{ old('to_date', $rentingCycle->to_date) }}">
                        @if($errors->has('to_date'))
                            <span class="text-danger">{{ $errors->first('to_date') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.rentingCycle.fields.to_date_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="total_days">{{ trans('cruds.rentingCycle.fields.total_days') }}</label>
                        <input class="form-control {{ $errors->has('total_days') ? 'is-invalid' : '' }}" readonly type="number" name="total_days" id="total_days" value="{{ old('total_days', $rentingCycle->total_days) }}" step="1">
                        @if($errors->has('total_days'))
                            <span class="text-danger">{{ $errors->first('total_days') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.rentingCycle.fields.total_days_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4" id="price_per_day_div" style="display: none;">
                    <div class="form-group">
                        <label for="price_per_day">{{ trans('cruds.rentingCycle.fields.price_per_day') }}</label>
                        <input class="form-control {{ $errors->has('price_per_day') ? 'is-invalid' : '' }}" type="number" name="price_per_day" id="price_per_day" value="{{ old('price_per_day', $rentingCycle->price_per_day) }}" step="1">
                        @if($errors->has('price_per_day'))
                            <span class="text-danger">{{ $errors->first('price_per_day') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.rentingCycle.fields.price_per_day_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="required" for="total_rent">{{ trans('cruds.rentingCycle.fields.total_rent') }}</label>
                        <input class="form-control {{ $errors->has('total_rent') ? 'is-invalid' : '' }}" type="number" name="total_rent" id="total_rent" value="{{ old('total_rent', $rentingCycle->total_rent) }}" step="0.01" required>
                        @if($errors->has('total_rent'))
                            <span class="text-danger">{{ $errors->first('total_rent') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.rentingCycle.fields.total_rent_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="deposit_received">{{ trans('cruds.rentingCycle.fields.deposit_received') }}</label>
                        <input class="form-control {{ $errors->has('deposit_received') ? 'is-invalid' : '' }}" type="number" name="deposit_received" id="deposit_received" value="{{ old('deposit_received', $rentingCycle->deposit_received) }}" step="0.01">
                        @if($errors->has('deposit_received'))
                            <span class="text-danger">{{ $errors->first('deposit_received') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.rentingCycle.fields.deposit_received_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.rentingCycle.fields.payment_option') }}</label>
                @foreach(App\Models\RentingCycle::PAYMENT_OPTION_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('payment_option') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="payment_option_{{ $key }}" name="payment_option" value="{{ $key }}" {{ old('payment_option', $rentingCycle->payment_option) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="payment_option_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('payment_option'))
                    <span class="text-danger">{{ $errors->first('payment_option') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rentingCycle.fields.payment_option_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.rentingCycle.fields.is_cancelled') }}</label>
                @foreach(App\Models\RentingCycle::IS_CANCELLED_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_cancelled') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_cancelled_{{ $key }}" name="is_cancelled" value="{{ $key }}" {{ old('is_cancelled', $rentingCycle->is_cancelled) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_cancelled_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_cancelled'))
                    <span class="text-danger">{{ $errors->first('is_cancelled') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rentingCycle.fields.is_cancelled_helper') }}</span>
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

@section('scripts')

<script type="text/javascript">
    $('#from_date').datetimepicker({
    format: 'YYYY-MM-DD',
    defaultDate: new Date() ,
    locale: 'en',
    collapse:true,
    icons: {
      up: 'fas fa-chevron-up',
      down: 'fas fa-chevron-down',
      previous: 'fas fa-chevron-left',
      next: 'fas fa-chevron-right'
    }
});
$('#from_date').on('dp.change', function() {
    getdate();
});


$(document).ready(function() {
    $("#total_hours_div").hide();
    $("#price_per_day_div").hide();
    getdate();
});


function getdate() {
    var from_date = document.getElementById('from_date').value;
    var date = new Date(from_date);
    var newdate = new Date(date);
    var sel_months = document.getElementById('sel_months').value;
    if(sel_months == 0){
        var days = 30;
    }else{
        var days = sel_months * 30;
    }
    newdate.setDate(newdate.getDate() + days);
    var dd = newdate.getDate();
    var m = newdate.getMonth() + 1;
    var y = newdate.getFullYear();
    if(m <= 9)
    m = '0'+m;
    if(dd <= 9)
    dd = '0'+dd;
    var FormattedDate = y + '-' + m + '-' + dd;
    document.getElementById('to_date').value = FormattedDate;
    document.getElementById('total_days').value = days;
}

function upd_months() {
    getdate();
    var sel_months = $('#sel_months').val();
    var rent = $('#monthly_rent').val();
    if(rent != ''){
        var total_rent = sel_months * rent;
        $('#total_rent').val(total_rent);
    }else{
        $('#total_rent').val('');
    }
    

}

$('#cycle_id').change(function(){
    var id = $(this).val();
    var url = '{{ route("renting-cycles.getCycleDetails",":id") }}';
    url = url.replace(":id",id);

    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        success: function(response){
            if(response != null){
                var sel_months = $('#sel_months').val();                
                $('#monthly_rent').val(response);
                if(sel_months != ''){
                    var total_rent = sel_months * response;
                    $('#total_rent').val(total_rent);
                }else{
                    $('#total_rent').val(response);
                }
               
            }
        }
    });
});

</script>
@endsection