@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.cycle.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Contact-messages">
            <thead>
                <tr>
                    <th>
                       Actions
                    </th>
                    <th>
                        Sr. No.
                    </th>
                    <th>
                        User Name
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Message
                    </th>
                    <th>
                        Mobile
                    </th>
                    <th>
                        Email
                    </th>
                </tr>
                <tr>
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
    ajax: "{{ route('contact-messages.index') }}",
    columns: [        
        { data: 'actions', name: '{{ trans('global.actions') }}', sortable: false, searchable: false },
        { data: 'DT_RowIndex', name: 'srno', sortable: false, searchable: false },        
        { data: 'user_id', name: 'user_id' },
        { data: 'name', name: 'name' },
        { data: 'message', name: 'message' },
        { data: 'mobile', name: 'mobile' },
        { data: 'email', name: 'email' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-Contact-messages').DataTable(dtOverrideGlobals);
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