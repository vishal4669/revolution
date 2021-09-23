@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.renting-cycles.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.rentingCycle.title_singular') }}
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.rentingCycle.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-RentingCycle">
            <thead>
                <tr>
                    <th>
                        Sr. No.
                    </th>
                    <th>
                        {{ trans('cruds.rentingCycle.fields.cycle') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingCycle.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingCycle.fields.booking_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingCycle.fields.total_hours') }}
                    </th>
                    <th>
                        From_Date
                    </th>
                    <th>
                        To_Date
                    </th>
                    <th>
                        {{ trans('cruds.rentingCycle.fields.total_days') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingCycle.fields.total_rent') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingCycle.fields.deposit_received') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingCycle.fields.payment_option') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingCycle.fields.is_cancelled') }}
                    </th>
                    <th>
                        Actions
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($cycles as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\RentingCycle::BOOKING_TYPE_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\RentingCycle::PAYMENT_OPTION_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\RentingCycle::IS_CANCELLED_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
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
@can('renting_cycle_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.renting-cycles.massDestroy') }}",
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
    ajax: "{{ route('admin.renting-cycles.index') }}",
    columns: [
        { data: 'DT_RowIndex', name: 'srno' },
        { data: 'cycle_name', name: 'cycle.name' },
        { data: 'user_name', name: 'user.name' },
        { data: 'booking_type', name: 'booking_type' },
        { data: 'total_hours', name: 'total_hours' },
        { data: 'from_date', name: 'from_date' },
        { data: 'to_date', name: 'to_date' },
        { data: 'total_days', name: 'total_days' },
        { data: 'total_rent', name: 'total_rent' },
        { data: 'deposit_received', name: 'deposit_received' },
        { data: 'payment_option', name: 'payment_option' },
        { data: 'is_cancelled', name: 'is_cancelled' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-RentingCycle').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection