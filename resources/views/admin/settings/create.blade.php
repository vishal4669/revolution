@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Settings
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("settings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="setting_type">Select field type</label>
                        <select class="form-control select2 {{ $errors->has('cycle') ? 'is-invalid' : '' }}" onchange="loadField()" name="setting_type"
                            id="setting_type" required>
                            <option value="">Select One</option>
                            <option value="date">Date</option>
                            <option value="text">Text</option>
                            <option value="time">Time</option>
                            <option value="slots">Slots</option>
                        </select>
                        @if($errors->has('sel_months'))
                        <span class="text-danger">Please enter months as numeric value. eg: 1 or 2 or 3</span>
                        @endif
                        <span class="help-block">Enter Key Name. (lower case only)</span>
                    </div>
                </div>
                <div class="col-md-4" id="setting_key">
                    <div class="form-group">
                        <label for="settings_key">Enter Key</label>
                        <input class="form-control {{ $errors->has('settings_key') ? 'is-invalid' : '' }}" type="text"
                            name="settings_key" id="settings_key" value="{{ old('settings_key', '') }}"="1">
                        @if($errors->has('sel_months'))
                        <span class="text-danger">Please enter months as numeric value. eg: 1 or 2 or 3</span>
                        @endif
                        <span class="help-block">Enter Key Name. (lower case only)</span>
                    </div>
                </div>
                <div class="col-md-4" id="setting_date" style="display:none">
                    <div class="form-group">
                        <label for="from_date">Select Date</label>
                        <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text"
                            name="date" id="date" value="{{ old('date') ? old('date') : date('d-m-Y') }}">
                        @if($errors->has('from_date'))
                        <span class="text-danger">{{ $errors->first('from_date') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.rentingCycle.fields.from_date_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-4" id="setting_text" style="display:none">
                    <div class="form-group" >
                        <label for="settings_value" id="setting_text_label">Enter Value</label>
                        <input class="form-control {{ $errors->has('settings_value') ? 'is-invalid' : '' }}" type="text"
                            name="settings_value" id="settings_value" value="{{ old('settings_value', '') }}">
                        @if($errors->has('sel_months'))
                        <span class="text-danger">Please enter months as numeric value. eg: 1 or 2 or 3</span>
                        @endif
                        <span class="help-block" id="setting_text_help">Enter Value.</span>
                    </div>                                        
                </div>                
                <div class="col-md-4" id="setting_time1" style="display:none"> 
                    <div class="form-group">
                        <label for="time_value1">Enter Time 1</label>
                        <input class="form-control hourly_time {{ $errors->has('time_value1') ? 'is-invalid' : '' }}" type="text"
                            name="time_value1" id="time_value1">
                        @if($errors->has('time'))
                        <span class="text-danger">Please enter months as numeric value. eg: 1 or 2 or 3</span>
                        @endif
                        <span class="help-block">Enter time.</span>
                    </div>
                </div>                                
                <div class="col-md-4" id="setting_time2" style="display:none"> 
                    <div class="form-group">
                        <label for="time_value2">Enter Time 2</label>
                        <input class="form-control hourly_time {{ $errors->has('time_value2') ? 'is-invalid' : '' }}" type="text"
                            name="time_value2" id="time_value2">
                        @if($errors->has('time'))
                        <span class="text-danger">Please enter months as numeric value. eg: 1 or 2 or 3</span>
                        @endif
                        <span class="help-block">Enter time.</span>
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

@section('scripts')
    <script type="text/javascript">
        function loadField(){
            var setting_type = $('#setting_type').val();
            if(setting_type == "date"){
                $('#setting_date').show();
                $('#setting_text').hide();
                $('#setting_time').hide();
                $('#setting_time2').hide();
            }else if(setting_type == "text"){
                $('#setting_date').hide();
                $('#setting_text').show();
                $('#setting_time').hide();
                $('#setting_time2').hide();
            }else if(setting_type == "time"){   
                $('#setting_date').hide();
                $('#setting_text').hide();
                $('#setting_time').show();
                $('#setting_time2').hide();
            }else if(setting_type == "slots"){   
                $('#setting_key').hide();
                $('#setting_date').hide();
                $('#setting_text_label').text("Slot Interval");
                $('#setting_text_help').text("Enter value in minutes. (eg. 15, 30, 60)");
                $('#setting_text').show();
                $('#setting_time1').show();
                $('#setting_time2').show();
            }else{
                $('#setting_date').hide();
                $('#setting_text').hide();
                $('#setting_time').hide();
                $('#setting_time2').hide();
            }
        }
    </script>   
@endsection