@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.renting-trainers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.rentingTrainer.title_singular') }}
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.rentingTrainer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-RentingTrainer">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.rentingTrainer.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingTrainer.fields.trainer') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingTrainer.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingTrainer.fields.booking_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingTrainer.fields.total_hours') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingTrainer.fields.from_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingTrainer.fields.to_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingTrainer.fields.total_days') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingTrainer.fields.price_per_day') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingTrainer.fields.total_rent') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingTrainer.fields.deposit_received') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingTrainer.fields.payment_option') }}
                    </th>
                    <th>
                        {{ trans('cruds.rentingTrainer.fields.is_cancelled') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($trainers as $key => $item)
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
                            @foreach(App\Models\RentingTrainer::BOOKING_TYPE_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\RentingTrainer::PAYMENT_OPTION_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\RentingTrainer::IS_CANCELLED_RADIO as $key => $item)
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.renting-trainers.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'trainer_name', name: 'trainer.name' },
{ data: 'user_name', name: 'user.name' },
{ data: 'booking_type', name: 'booking_type' },
{ data: 'total_hours', name: 'total_hours' },
{ data: 'from_date', name: 'from_date' },
{ data: 'to_date', name: 'to_date' },
{ data: 'total_days', name: 'total_days' },
{ data: 'price_per_day', name: 'price_per_day' },
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
  let table = $('.datatable-RentingTrainer').DataTable(dtOverrideGlobals);
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