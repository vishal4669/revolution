@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.testimonials.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.testimonial.title_singular') }}
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.testimonial.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Testimonial">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.testimonial') }}
                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.user_photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.testimonial.fields.is_visible') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonials as $key => $testimonial)
                        <tr data-entry-id="{{ $testimonial->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $testimonial->id ?? '' }}
                            </td>
                            <td>
                                {{ $testimonial->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $testimonial->testimonial ?? '' }}
                            </td>
                            <td>
                                @if($testimonial->user_photo)
                                    <a href="{{ $testimonial->user_photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $testimonial->user_photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                <span style="display:none">{{ $testimonial->is_visible ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $testimonial->is_visible ? 'checked' : '' }}>
                            </td>
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.testimonials.show', $testimonial->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.testimonials.edit', $testimonial->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    pageLength: 10,
  });
  let table = $('.datatable-Testimonial:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection