@include('layouts2.header')
@include('layouts2.navigation')

<style type="text/css">
  .green_color{color: green;}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">

        <div class="row mb-2">
          <div class="col-sm-10">
            <h1 class="m-0">Block Slot</h1>
          </div><!-- /.col -->
          
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="box box-default">

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
        @endif
        
        @if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
               @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
               @endforeach
            </ul>
          </div>
        @endif

        <div class="box-body">

          {!! Form::open(array('route' => 'slots.store','method'=>'POST', 'enctype' => 'multipart/form-data', 'name' => 'blockslot')) !!}

          <div class="row">


              <div class="col-md-12">
                 <div id='calendar'></div>
              </div>

              <div class="col-md-12">
                <strong>Blocked Slots:</strong>
                <input type="hidden" name="from_date" id="from_date">
                <input type="hidden" name="to_date" id="to_date">
                 <div id='calendarData' class="row">                  
                     <h4>Please select date from above calender to block slots</h4>
                 </div>
              </div>
              

              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>

          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </section>

     <br>
</div>   

@include('layouts2.footer')

 <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js'></script>

<script type="text/javascript">
   
    $(document).ready(function(){
        

        // Initialize form validation on the registration form.
          // It has the name attribute "registration"
          $("form[name='blockslot']").validate({
            // Specify validation rules
            rules: {
              // The key name on the left side is the name attribute
              // of an input field. Validation rules are defined
              // on the right side
              mst_trainer_id:"required",
              users_id:"required"
              
            },
            // Specify validation error messages
            messages: {
              mst_trainer_id:"Please select trainer",
              users_id:"Please select user"
              
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
              form.submit();
            }
          });

    });

    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      timeZone: 'UTC',
      initialView: 'dayGridMonth',
      editable: true,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
        dayClick: function (date, allDay, jsEvent, view) {
          $(".fc-state-highlight").removeClass("fc-state-highlight");
          $(jsEvent.target).addClass("fc-state-highlight");
     },
     select: function(info) {

        var date = new Date(info.endStr);
        var days = 1;
        var last_date = new Date(date - days*24*60*60*1000);
        var first_date = moment(info.startStr).format('DD-MM-YYYY');  
        var second_date = moment(last_date).format('DD-MM-YYYY');

        var from_date = moment(info.startStr).format('YYYY-MM-DD');  
        var to_date = moment(last_date).format('YYYY-MM-DD');

        $("#from_date").val(from_date);  
        $("#to_date").val(to_date);  

        $("#calendarData").html('<b>Selected Dates : </b>&nbsp;&nbsp;' + first_date + ' to ' + second_date);
      },
      selectable:true,      
      selectHelper: true,
        dateClick: function(info) {          
          var booking_date = info.dateStr;          
          $("#label_selected_date").html(booking_date);
        },

        dateSelect: function(info) {
          console.log(info);
        }
    });

    calendar.render();
  });

</script>
<style type="text/css">
  #calendar{
    height: 500px !important;
  }

  #calendarData{min-height: 50px; border: 1px solid lightslategray; padding: 8px; margin: 5px;}
</style>

