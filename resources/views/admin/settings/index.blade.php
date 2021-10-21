@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.settings.create') }}">
                Create Settings
            </a>
        </div>
    </div>


    <!-- /.row -->
    <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Activate-Deactivate Slots
            </h3>
          </div>
          <div class="card-body">
            <h4>Day of Week</h4>
            <div class="row">
              <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="vert-tabs-monday-tab" data-toggle="pill" href="#vert-tabs-monday" role="tab" aria-controls="vert-tabs-monday" aria-selected="true">Monday</a>
                  <a class="nav-link" id="vert-tabs-tuesday-tab" data-toggle="pill" href="#vert-tabs-tuesday" role="tab" aria-controls="vert-tabs-tuesday" aria-selected="false">Tuesday</a>
                  <a class="nav-link" id="vert-tabs-wednesday-tab" data-toggle="pill" href="#vert-tabs-wednesday" role="tab" aria-controls="vert-tabs-wednesday" aria-selected="false">Wednesday</a>
                  <a class="nav-link" id="vert-tabs-thursday-tab" data-toggle="pill" href="#vert-tabs-thursday" role="tab" aria-controls="vert-tabs-thursday" aria-selected="false">Thursday</a>
                  <a class="nav-link" id="vert-tabs-friday-tab" data-toggle="pill" href="#vert-tabs-friday" role="tab" aria-controls="vert-tabs-friday" aria-selected="false">Friday</a>
                  <a class="nav-link" id="vert-tabs-saturday-tab" data-toggle="pill" href="#vert-tabs-saturday" role="tab" aria-controls="vert-tabs-saturday" aria-selected="false">Saturday</a>
                  <a class="nav-link" id="vert-tabs-sunday-tab" data-toggle="pill" href="#vert-tabs-sunday" role="tab" aria-controls="vert-tabs-sunday" aria-selected="false">Sunday</a>
                </div>
              </div>
              <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class="tab-pane text-left fade show active" id="vert-tabs-monday" role="tabpanel" aria-labelledby="vert-tabs-monday-tab">
                    <table class="table table-bordered text-center">
                      <thead>
                        <tr>
                          <th>Slot</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($weekly_slots as $slot)
                          @if($slot->day_of_week == 1)                          
                            <tr>
                              <td>{{ $slot->slot->slot_start_time }} - {{ $slot->slot->slot_end_time }}</td>
                              <td>
                                <input type="checkbox" class="clot" value="{{ $slot->id }}" name="my-checkbox" {{ $slot->is_active == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success"> 
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-tuesday" role="tabpanel" aria-labelledby="vert-tabs-tuesday-tab">
                    <table class="table table-bordered text-center">
                      <thead>
                        <tr>
                          <th>Slot</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($weekly_slots as $slot)
                          @if($slot->day_of_week == 2)                          
                            <tr>
                              <td>{{ $slot->slot->slot_start_time }} - {{ $slot->slot->slot_end_time }}</td>
                              <td>
                                <input type="checkbox" value="{{ $slot->id }}" name="my-checkbox" {{ $slot->is_active == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success"> 
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-wednesday" role="tabpanel" aria-labelledby="vert-tabs-wednesday-tab">
                    <table class="table table-bordered table-condensed text-center">
                      <thead>
                        <tr>
                          <th>Slot</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($weekly_slots as $slot)
                          @if($slot->day_of_week == 3)                          
                            <tr>
                              <td>{{ $slot->slot->slot_start_time }} - {{ $slot->slot->slot_end_time }}</td>
                              <td>
                                <input type="checkbox" value="{{ $slot->id }}" name="my-checkbox" {{ $slot->is_active == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success"> 
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-thursday" role="tabpanel" aria-labelledby="vert-tabs-thursday-tab">
                    <table class="table table-bordered text-center">
                      <thead>
                        <tr>
                          <th>Slot</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($weekly_slots as $slot)
                          @if($slot->day_of_week == 4)                          
                            <tr>
                              <td>{{ $slot->slot->slot_start_time }} - {{ $slot->slot->slot_end_time }}</td>
                              <td>
                                <input type="checkbox" value="{{ $slot->id }}" name="my-checkbox" {{ $slot->is_active == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success"> 
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-friday" role="tabpanel" aria-labelledby="vert-tabs-friday-tab">
                    <table class="table table-bordered text-center">
                      <thead>
                        <tr>
                          <th>Slot</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($weekly_slots as $slot)
                          @if($slot->day_of_week == 5)                          
                            <tr>
                              <td>{{ $slot->slot->slot_start_time }} - {{ $slot->slot->slot_end_time }}</td>
                              <td>
                                <input type="checkbox" value="{{ $slot->id }}" name="my-checkbox" {{ $slot->is_active == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success"> 
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-saturday" role="tabpanel" aria-labelledby="vert-tabs-saturday-tab">
                   <table class="table table-bordered text-center">
                      <thead>
                        <tr>
                          <th>Slot</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($weekly_slots as $slot)
                          @if($slot->day_of_week == 6)                          
                            <tr>
                              <td>{{ $slot->slot->slot_start_time }} - {{ $slot->slot->slot_end_time }}</td>
                              <td>
                                <input type="checkbox" value="{{ $slot->id }}" name="my-checkbox" {{ $slot->is_active == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success"> 
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-sunday" role="tabpanel" aria-labelledby="vert-tabs-sunday-tab">
                    <table class="table table-bordered text-center">
                      <thead>
                        <tr>
                          <th>Slot</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($weekly_slots as $slot)
                          @if($slot->day_of_week == 7)                          
                            <tr>
                              <td>{{ $slot->slot->slot_start_time }} - {{ $slot->slot->slot_end_time }}</td>
                              <td>
                                <input type="checkbox" value="{{ $slot->id }}" name="my-checkbox" {{ $slot->is_active == 1 ? 'checked' : '' }} data-bootstrap-switch data-off-color="danger" data-on-color="success"> 
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <!-- /.card -->
        </div>
        <!-- /.card -->



@endsection
@section('scripts')
@parent
<script type="text/javascript">
$(function () {

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));



    });

  




});


$("[name='my-checkbox']").bootstrapSwitch({
  onSwitchChange: function(e, state) {
    
    var c_val =  $(this).val();
    $.ajax({
        type: "POST",
        async: true,
        url: "{{ route('admin.slots.changeStatus') }}",
        data: {"id":c_val}
        });

  }
});


function myfunc(s_id){
  alert(s_id);
}
</script>
@endsection