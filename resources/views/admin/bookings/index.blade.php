@include('layouts2.header')
@include('layouts2.navigation')

<style type="text/css">
  .dataTables_wrapper{width: 100%}
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-8">
            <h1 class="m-0">Trainerwise Bookings & Rentals</h1>
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
             
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <strong>Type:</strong>
                          {!! Form::select('type', $types, null, ['class' => 'form-control', 'id' => 'type']) !!}
                      </div>                      
                  </div>

                  <div class="col-md-6">
                      <div class="form-group">
                          <strong>Trainer:</strong>
                          {!! Form::select('mst_trainer_id', $trainers, null, ['class' => 'form-control', 'id' => 'mst_trainer_id']) !!}
                      </div>                  
                  </div>
                </div>    

               <div class="row" id="bookingtables">            

                <table style="width: 100%" id="bookings" data-order='[[ 0, "desc" ]]' class="table table-bordered table-striped">
                  <thead>                
                        <tr>
                           <th>No</th>
                           <th>User</th>
                           <th>Trainer</th>
                           <th>Date & Time</th>
                           <th>Booking Amount</th>
                           <th>Status</th>
                           <th width="150px">Action</th>
                        </tr>
                  </thead>                  
                </table>
                <table style="width: 100%" id="RentalBookings" data-order='[[ 0, "desc" ]]' class="table table-bordered table-striped">
                  <thead>                
                        <tr>
                           <th>No</th>
                           <th>User</th>
                           <th>Trainer</th>
                           <th>From Date</th>
                           <th>To Date</th>
                           <th>Price Per Day</th>
                           <th>Total Days</th>
                           <th>Total Price</th>
                           <th width="150px">Action</th>
                        </tr>
                  </thead>                  
                </table>

              </div>

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

      $('#bookingtables').hide();

      // DataTable
      var CafeTable = $('#bookings').DataTable({
         processing: true,
         serverSide: true,
         "searching": false,
         ajax: {
            url : "{{route('admin.bookings.getBookings')}}",
            data: function (d) {
                d.mst_trainer_id = $('#mst_trainer_id').val()
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

      // DataTable
      var RentalTable = $('#RentalBookings').DataTable({
         processing: true,
         serverSide: true,
         "searching": false,
         ajax: {
            url : "{{route('admin.rentalbookings.getRentalBookings')}}",
            data: function (d) {
                d.mst_trainer_id = $('#mst_trainer_id').val()
            }
         },
         columns: [
            { data: 'no' },
            { data: 'user' },
            { data: 'trainer' },
            { data: 'from_date' },
            { data: 'to_date' },
            { data: 'price_per_day' },
            { data: 'total_days' },
            { data: 'total_price' },
            { data: 'action' }
         ]
      });

      $('#type').change(function(){

          if(this.value=='1') {
            $('#bookingtables').show();
            $('#bookings_wrapper').hide();
            $('#RentalBookings_wrapper').show();

          } else if(this.value=='2') {
            $('#bookingtables').show();
              $('#bookings_wrapper').show();
              $('#RentalBookings_wrapper').hide();
          } else {
            $('#bookingtables').hide();
              $('#bookings_wrapper').hide();
              $('#RentalBookings_wrapper').hide();
          }
      });

      $('#mst_trainer_id').change(function(){
          CafeTable.draw();
          RentalTable.draw();
      });     

    });
    </script>