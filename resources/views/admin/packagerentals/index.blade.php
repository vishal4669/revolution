@include('layouts2.header')
@include('layouts2.navigation')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0">Trainer Package Rental Management</h1>
          </div>
          <div class="pull-right">
              <a class="btn btn-success" href="{{ route('admin.packagerentals.create') }}"> Create Trainer Package Rental</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
        @endif

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Trainer Packages Rental</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" data-order='[[ 0, "desc" ]]' class="table table-bordered table-striped">
                  <thead>                
                        <tr>
                           <th>No</th>
                           <th>Trainer Name</th>
                           <th>Price Per Day</th>
                           <th>Total Days</th>
                           <th>Total Price</th>
                           <th>Terms & Conditions</th>
                           <th width="280px">Action</th>
                        </tr>
                  </thead>
                  <tbody>
                   @php
                   $i = 1;
                   @endphp 
                   @foreach ($packagerentals as $key => $packagerental)

                    <tr>
                      <td>{{$i}}</td>
                      <td>{{ $packagerental->trainer->trainer_name }}</td>
                      <td>{{ $packagerental->price_per_day }}</td>
                      <td>{{ $packagerental->total_number_of_days }}</td>
                      <td>{{ $packagerental->total_price }}</td>
                      <td>{{ $packagerental->terms_n_conditions }}</td>
                      <td>
                          {!! Form::open(['method' => 'DELETE','onclick'=>'return confirm("are you sure to delete?")','route' => ['packagerentals.destroy', $packagerental->id],'style'=>'display:inline']) !!}
                              {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                          {!! Form::close() !!}
                      </td>
                    </tr>
                    @php
                      $i++;
                   @endphp 
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
    <!-- /.content -->
  </div>

  @include('layouts2.footer')

  <script type="text/javascript">
    $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      // DataTable
      var table = $('#bookings').DataTable({
         processing: true,
         serverSide: true,
         "searching": false,
         ajax: {
            url : "{{route('admin.rentalbookings.getRentalBookings')}}",
            data: function (d) {
                d.users_id = $('#users_id').val(),
                d.mst_trainer_id = $('#mst_trainer_id').val(),
                d.booking_date = $('#booking_date').val()
            }
         },
         columns: [
            { data: 'no' },
            { data: 'user' },
            { data: 'trainer' },
            { data: 'datetime' },
            { data: 'booking_amount' },
            { data: 'status' },
            { data: 'action' }
         ]
      });

      $('#users_id').change(function(){
          table.draw();
      });
      $('#mst_trainer_id').change(function(){
          table.draw();
      });
      $('#booking_date').change(function(){
          table.draw();
      });

    });
    </script>