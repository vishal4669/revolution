@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Cycles Due Date-wise
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reports.due-cycles") }}">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="from_date">From:</label>
                        <input class="form-control date {{ $errors->has('from_date') ? 'is-invalid' : '' }}" type="text" name="from_date" id="from_date" value="{{ old('from_date') }}">
                        @if($errors->has('lr_date'))
                            <span class="text-danger">{{ $errors->first('from_date') }}</span>
                        @endif
                        <span class="help-block">Select start date of report.</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="to_date">To:</label>
                        <input class="form-control date {{ $errors->has('to_date') ? 'is-invalid' : '' }}" type="text" name="to_date" id="to_date" value="{{ old('to_date') }}">
                        @if($errors->has('to_date'))
                            <span class="text-danger">{{ $errors->first('to_date') }}</span>
                        @endif
                        <span class="help-block">Select end date of report.</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    View
                </button>
            </div>
        </form>
    </div>
</div>



@endsection