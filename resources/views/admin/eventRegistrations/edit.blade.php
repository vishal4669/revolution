@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.eventRegistration.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("event-registrations.update", [$eventRegistration->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.eventRegistration.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $eventRegistration->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventRegistration.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="event_id">{{ trans('cruds.eventRegistration.fields.event') }}</label>
                <select class="form-control select2 {{ $errors->has('event') ? 'is-invalid' : '' }}" name="event_id" id="event_id" required>
                    @foreach($events as $id => $entry)
                        <option value="{{ $id }}" {{ (old('event_id') ? old('event_id') : $eventRegistration->event->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('event'))
                    <span class="text-danger">{{ $errors->first('event') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventRegistration.fields.event_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ticket_id">{{ trans('cruds.eventRegistration.fields.ticket') }}</label>
                <select class="form-control select2 {{ $errors->has('ticket') ? 'is-invalid' : '' }}" name="ticket_id" id="ticket_id" required>
                    @foreach($tickets as $id => $entry)
                        <option value="{{ $id }}" {{ (old('ticket_id') ? old('ticket_id') : $eventRegistration->ticket->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ticket'))
                    <span class="text-danger">{{ $errors->first('ticket') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventRegistration.fields.ticket_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.eventRegistration.fields.payment_mode') }}</label>
                @foreach(App\Models\EventRegistration::PAYMENT_MODE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('payment_mode') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="payment_mode_{{ $key }}" name="payment_mode" value="{{ $key }}" {{ old('payment_mode', $eventRegistration->payment_mode) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="payment_mode_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('payment_mode'))
                    <span class="text-danger">{{ $errors->first('payment_mode') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventRegistration.fields.payment_mode_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.eventRegistration.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $eventRegistration->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventRegistration.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount_received">{{ trans('cruds.eventRegistration.fields.amount_received') }}</label>
                <input class="form-control {{ $errors->has('amount_received') ? 'is-invalid' : '' }}" type="number" name="amount_received" id="amount_received" value="{{ old('amount_received', $eventRegistration->amount_received) }}" step="0.01">
                @if($errors->has('amount_received'))
                    <span class="text-danger">{{ $errors->first('amount_received') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventRegistration.fields.amount_received_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="transaction">{{ trans('cruds.eventRegistration.fields.transaction') }}</label>
                <input class="form-control {{ $errors->has('transaction') ? 'is-invalid' : '' }}" type="text" name="transaction" id="transaction" value="{{ old('transaction', $eventRegistration->transaction) }}" required>
                @if($errors->has('transaction'))
                    <span class="text-danger">{{ $errors->first('transaction') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventRegistration.fields.transaction_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="unique_reg_no">{{ trans('cruds.eventRegistration.fields.unique_reg_no') }}</label>
                <input class="form-control {{ $errors->has('unique_reg_no') ? 'is-invalid' : '' }}" type="text" name="unique_reg_no" id="unique_reg_no" value="{{ old('unique_reg_no', $eventRegistration->unique_reg_no) }}" required>
                @if($errors->has('unique_reg_no'))
                    <span class="text-danger">{{ $errors->first('unique_reg_no') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.eventRegistration.fields.unique_reg_no_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.event-registrations.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $eventRegistration->id ?? 0 }}');
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