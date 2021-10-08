@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.trainer-settings.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.trainerSetting.title_singular') }}
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.trainerSetting.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-TrainerSetting">
                <thead>
                    <tr>
                        <th>
                            Actions
                        </th>
                        <th>
                            Sr. No.
                        </th>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.trainer') }}
                        </th>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.rent_per_hour') }}
                        </th>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.rent_per_day') }}
                        </th>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.rent_per_week') }}
                        </th>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.rent_per_fortnight') }}
                        </th>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.slot_booking_limit') }}
                        </th>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.booking_amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.trainerSetting.fields.is_cafe_trainer') }}
                        </th>
                        <th>
                            Booking Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trainerSettings as $key => $trainerSetting)
                        <tr data-entry-id="{{ $trainerSetting->id }}">
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.trainer-settings.show', $trainerSetting->id) }}">
                                    {{ trans('global.view') }}
                                </a>
                                <a class="btn btn-xs btn-info" href="{{ route('admin.trainer-settings.edit', $trainerSetting->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                                <form action="{{ route('admin.trainer-settings.destroy', $trainerSetting->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
                            </td>
                            <td>
                                {{ $loop->iteration ?? '' }}
                            </td>
                            <td>
                                {{ $trainerSetting->trainer->name ?? '' }}
                            </td>
                            <td>
                                {{ $trainerSetting->rent_per_hour ?? '' }}
                            </td>
                            <td>
                                {{ $trainerSetting->rent_per_day ?? '' }}
                            </td>
                            <td>
                                {{ $trainerSetting->rent_per_week ?? '' }}
                            </td>
                            <td>
                                {{ $trainerSetting->rent_per_fortnight ?? '' }}
                            </td>
                            <td>
                                {{ $trainerSetting->slot_booking_limit ?? '' }}
                            </td>
                            <td>
                                {{ $trainerSetting->booking_amount ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\TrainerSetting::IS_CAFE_TRAINER_RADIO[$trainerSetting->is_cafe_trainer] ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\TrainerSetting::BOOKING_ACTIVE_RADIO[$trainerSetting->booking_active] ?? '' }}
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
    order: [[ 2, 'asc' ]],
    "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0, 1, 3, 4, 5, 6, 7, 8 ] }, 
        { "bSearchable": false, "aTargets": [ 0, 1, 3, 4, 5, 6, 7, 8 ] }
    ],
    pageLength: 10,
  });
  let table = $('.datatable-TrainerSetting:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection