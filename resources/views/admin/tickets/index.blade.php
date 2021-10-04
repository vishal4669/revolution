@extends('layouts.admin')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tickets.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.ticket.title_singular') }}
            </a>
        </div>
    </div>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.ticket.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Ticket">
                <thead>
                    <tr>
                        <th>
                            Actions
                        </th>
                        <th>
                            Sr.No.
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.event') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.ticket_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.ticket_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.max_entries') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.booked_tickets') }}
                        </th>
                        <th>
                            {{ trans('cruds.ticket.fields.stop_booking') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $key => $ticket)
                        <tr data-entry-id="{{ $ticket->id }}">
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('admin.tickets.show', $ticket->id) }}">
                                    {{ trans('global.view') }}
                                </a>

                                <a class="btn btn-xs btn-info" href="{{ route('admin.tickets.edit', $ticket->id) }}">
                                    {{ trans('global.edit') }}
                                </a>

                                <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
                            </td>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $ticket->event->name ?? '' }}
                            </td>
                            <td>
                                {{ $ticket->ticket_name ?? '' }}
                            </td>
                            <td>
                                {{ $ticket->ticket_price ?? '' }}
                            </td>
                            <td>
                                {{ $ticket->max_entries ?? '' }}
                            </td>
                            <td>
                                {{ $ticket->booked_tickets ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Ticket::STOP_BOOKING_RADIO[$ticket->stop_booking] ?? '' }}
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
    order: [[ 2, 'desc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-Ticket:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection