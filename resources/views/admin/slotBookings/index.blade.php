@extends('layouts.admin')
@section('content')
@can('slot_booking_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.slot-bookings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.slotBooking.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.slotBooking.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <form method="POST" id="user_select" role="form">
            {{csrf_field()}}
            <input type="hidden" value="123" name="user" id="user"/>
        </form>
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SlotBooking">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.slotBooking.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.slotBooking.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.slotBooking.fields.hrs_used') }}
                    </th>
                    <th>
                        Boooked Date
                    </th>
                    <th>
                        Booked Time
                    </th>
                    <th>
                        {{ trans('cruds.slotBooking.fields.booked_via') }}
                    </th>
                    <th>
                        {{ trans('cruds.slotBooking.fields.is_cancelled') }}
                    </th>
                    <th>
                        {{ trans('cruds.slotBooking.fields.cancelled_by') }}
                    </th>
                    <th>
                        {{ trans('cruds.slotBooking.fields.remarks') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(document).ready(function(){
    $('#user-select').on('submit', function(e) {
        table.draw();
        e.preventDefault();
    });
});
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: {
        url: "{{ route('admin.slot-bookings.index') }}",
        type: "POST",
        data: function (d) {
                d.user_id = $('input[name=user]').val();
                d._token = _token;
            }, 
    },
    columns: [
{ data: 'id', name: 'id' },
{ data: 'user_name', name: 'user.name' },
{ data: 'hrs_used', name: 'hrs_used' },
{ data: 'date', name: 'booking_date' },
{ data: 'booked_time', name: 'booked_time' },
{ data: 'booked_via', name: 'booked_via' },
{ data: 'is_cancelled', name: 'is_cancelled' },
{ data: 'cancelled_by', name: 'cancelled_by' },
{ data: 'remarks', name: 'remarks' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-SlotBooking').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection