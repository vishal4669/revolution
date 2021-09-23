@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.cycle-settings.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.cycleSetting.title_singular') }}
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.cycleSetting.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CycleSetting">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.cycle') }}
                        </th>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.rent_per_hour') }}
                        </th>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.rent_per_day') }}
                        </th>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.rent_per_week') }}
                        </th>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.rent_per_fortnight') }}
                        </th>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.slot_booking_limit') }}
                        </th>
                        <th>
                            {{ trans('cruds.cycleSetting.fields.booking_amount') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cycleSettings as $key => $cycleSetting)
                        <tr data-entry-id="{{ $cycleSetting->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $cycleSetting->id ?? '' }}
                            </td>
                            <td>
                                {{ $cycleSetting->cycle->name ?? '' }}
                            </td>
                            <td>
                                {{ $cycleSetting->rent_per_hour ?? '' }}
                            </td>
                            <td>
                                {{ $cycleSetting->rent_per_day ?? '' }}
                            </td>
                            <td>
                                {{ $cycleSetting->rent_per_week ?? '' }}
                            </td>
                            <td>
                                {{ $cycleSetting->rent_per_fortnight ?? '' }}
                            </td>
                            <td>
                                {{ $cycleSetting->slot_booking_limit ?? '' }}
                            </td>
                            <td>
                                {{ $cycleSetting->booking_amount ?? '' }}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.cycle-settings.show', $cycleSetting->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                                <a class="btn btn-xs btn-info" href="{{ route('admin.cycle-settings.edit', $cycleSetting->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                                <form action="{{ route('admin.cycle-settings.destroy', $cycleSetting->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-CycleSetting:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection