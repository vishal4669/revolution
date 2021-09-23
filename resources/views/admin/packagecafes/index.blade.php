@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-sm-12">
            <a class="btn btn-success" href="{{ route('admin.packagecafes.create') }}"> Create New Package (Trainer)</a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Packages List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="packages" data-order='[[ 0, "desc" ]]'
                            class="table table-bordered table-striped table-hover table-wrap">
                            <thead>
                                <tr>
                                    <th >Action</th>
                                    <!-- <th>Sr. No</th> -->
                                    <th>Package Name</th>
                                    <th>Validity</th>
                                    <th>Price Per Hour</th>
                                    <th>Total Hours</th>
                                    <th>Total Price</th>
                                    <th>Package Tax</th>
                                    <th>Is Cycle Included</th>
                                    <th>Is Aadhar Verification Required</th>
                                    <th>Terms & Conditions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packagecafes as $key => $packagecafe)
                                <tr>
                                    <td>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.packagecafes.show',$packagecafe->id) }}">Show</a> 
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.packagecafes.edit',$packagecafe->id) }}">Edit</a> 
                                    <form action="{{ route('admin.packagecafes.destroy', $packagecafe->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>  
                                    </td>
                                    <!--     -->
                                    <td>{{ $packagecafe->package_name }}</td>
                                    <td>{{ $packagecafe->validity }}</td>
                                    <td>{{ $packagecafe->price_per_hour }}</td>
                                    <td>{{ ($packagecafe->total_hours && $packagecafe->total_hours!=0) ? ($packagecafe->total_hours / 60) : 0 }}
                                    </td>
                                    <td>{{ $packagecafe->total_price }}</td>
                                    <td>{{ $packagecafe->package_tax }}</td>
                                    <td>
                                        @if($packagecafe->is_cycle_included == 1)
                                            Yes
                                        @else
                                            No
                                        @endif 
                                    </td>
                                    <td>
                                        @if($packagecafe->is_aadhar_verification_required == 1)
                                            Yes
                                        @else
                                            No
                                        @endif 
                                    </td>
                                    <td>{{ $packagecafe->terms_n_conditions }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

@endsection
@section('scripts')
@parent

<script>
$(function() {
    $('#packages').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
});
</script>

@endsection