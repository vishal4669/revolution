@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ticket.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tickets.update", [$ticket->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="event_id">{{ trans('cruds.ticket.fields.event') }}</label>
                <select class="form-control select2 {{ $errors->has('event') ? 'is-invalid' : '' }}" name="event_id" id="event_id" required>
                    @foreach($events as $id => $entry)
                        <option value="{{ $id }}" {{ (old('event_id') ? old('event_id') : $ticket->event->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('event'))
                    <span class="text-danger">{{ $errors->first('event') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.event_helper') }}</span>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                    <label class="required" for="ticket_name">{{ trans('cruds.ticket.fields.ticket_name') }}</label>
                    <input class="form-control {{ $errors->has('ticket_name') ? 'is-invalid' : '' }}" type="text" name="ticket_name" id="ticket_name" value="{{ old('ticket_name', $ticket->ticket_name) }}" required>
                    @if($errors->has('ticket_name'))
                        <span class="text-danger">{{ $errors->first('ticket_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.ticket.fields.ticket_name_helper') }}</span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label class="required" for="ticket_price">{{ trans('cruds.ticket.fields.ticket_price') }}</label>
                    <input class="form-control {{ $errors->has('ticket_price') ? 'is-invalid' : '' }}" type="number" name="ticket_price" id="ticket_price" value="{{ old('ticket_price', $ticket->ticket_price) }}" step="0.01" required>
                    @if($errors->has('ticket_price'))
                        <span class="text-danger">{{ $errors->first('ticket_price') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.ticket.fields.ticket_price_helper') }}</span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label class="required" for="max_entries">{{ trans('cruds.ticket.fields.max_entries') }}</label>
                    <input class="form-control {{ $errors->has('max_entries') ? 'is-invalid' : '' }}" type="number" name="max_entries" id="max_entries" value="{{ old('max_entries', $ticket->max_entries) }}" step="1" required>
                    @if($errors->has('max_entries'))
                        <span class="text-danger">{{ $errors->first('max_entries') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.ticket.fields.max_entries_helper') }}</span>
                </div>
              </div>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.ticket.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $ticket->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="booked_tickets">{{ trans('cruds.ticket.fields.booked_tickets') }}</label>
                <input class="form-control {{ $errors->has('booked_tickets') ? 'is-invalid' : '' }}" type="number" name="booked_tickets" id="booked_tickets" value="{{ old('booked_tickets', $ticket->booked_tickets) }}" step="1">
                @if($errors->has('booked_tickets'))
                    <span class="text-danger">{{ $errors->first('booked_tickets') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.booked_tickets_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.ticket.fields.stop_booking') }}</label>
                @foreach(App\Models\Ticket::STOP_BOOKING_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('stop_booking') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="stop_booking_{{ $key }}" name="stop_booking" value="{{ $key }}" {{ old('stop_booking', $ticket->stop_booking) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="stop_booking_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('stop_booking'))
                    <span class="text-danger">{{ $errors->first('stop_booking') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.stop_booking_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.tickets.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $ticket->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection