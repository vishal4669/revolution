@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Show Package
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.packagecafes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Package Name
                        </th>
                        <td>
                            {{ $package->package_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Validity
                        </th>
                        <td>
                            {{ $package->validity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Price per Hour
                        </th>
                        <td>
                            {{ $package->price_per_hour }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Total Hours
                        </th>
                        <td>
                            {{ $package->total_hours }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Package Price
                        </th>
                        <td>
                            {{ $package->total_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Is Cycle Included
                        </th>
                        <td>
                            @if($package->is_cycle_included == 1)
                               Cycle Included
                            @else
                                Cycle not included
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Terms & Conditions
                        </th>
                        <td>
                            {{ $package->terms_n_conditions }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.packagecafes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection