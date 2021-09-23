@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.trainers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.trainer.title_singular') }}
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.trainer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Trainer">
            <thead>
                <tr>
                    <th width="10">
                        Actions
                    </th>
                    <th>
                        Sr.No.
                    </th>
                    <th>
                        {{ trans('cruds.trainer.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.trainer.fields.photo') }}
                    </th>
                    <th>
                        {{ trans('cruds.trainer.fields.trainer_cost') }}
                    </th>
                    <th>
                        {{ trans('cruds.trainer.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.trainer.fields.serial_number') }}
                    </th>
                    <th>
                        {{ trans('cruds.trainer.fields.rent_month') }}
                    </th>
                    <th>
                        {{ trans('cruds.trainer.fields.rent_hour') }}
                    </th>
                    <th>
                        {{ trans('cruds.trainer.fields.is_active') }}
                    </th>
                    <th>
                        {{ trans('cruds.trainer.fields.is_rented') }}
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Trainer::TYPE_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Trainer::IS_ACTIVE_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Trainer::IS_RENTED_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
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
  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.trainers.index') }}",
    columns: [
    { data: 'actions', name: '{{ trans('global.actions') }}' },
    { data: 'DT_RowIndex', name: 'srno', sortable: false, searchable: false },
    { data: 'name', name: 'name' },
    { data: 'photo', name: 'photo', sortable: false, searchable: false },
    { data: 'trainer_cost', name: 'trainer_cost' },
    { data: 'type', name: 'type' },
    { data: 'serial_number', name: 'serial_number' },
    { data: 'rent_month', name: 'rent_month' },
    { data: 'rent_hour', name: 'rent_hour' },
    { data: 'is_active', name: 'is_active' },
    { data: 'is_rented', name: 'is_rented' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-Trainer').DataTable(dtOverrideGlobals);
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