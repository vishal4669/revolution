@extends('layouts.admin')
@section('content')
@can('event_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.events.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.event.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.event.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Event">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.event.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.event_images') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.last_booking_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.event_start_day') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.location') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.event_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.reporting_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.start_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.end_time') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.is_active') }}
                    </th>
                    <th>
                        {{ trans('cruds.event.fields.is_cancelled') }}
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
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('event_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.events.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.events.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'event_images', name: 'event_images', sortable: false, searchable: false },
{ data: 'last_booking_date', name: 'last_booking_date' },
{ data: 'event_start_day', name: 'event_start_day' },
{ data: 'location', name: 'location' },
{ data: 'event_type', name: 'event_type' },
{ data: 'reporting_time', name: 'reporting_time' },
{ data: 'start_time', name: 'start_time' },
{ data: 'end_time', name: 'end_time' },
{ data: 'is_active', name: 'is_active' },
{ data: 'is_cancelled', name: 'is_cancelled' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-Event').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection