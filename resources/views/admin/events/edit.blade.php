@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.events.update", [$event->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.event.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $event->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.name_helper') }}</span>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="event_images">{{ trans('cruds.event.fields.event_images') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('event_images') ? 'is-invalid' : '' }}" id="event_images-dropzone">
                    </div>
                    @if($errors->has('event_images'))
                        <span class="text-danger">{{ $errors->first('event_images') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.event_images_helper') }}</span>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="terms">{{ trans('cruds.event.fields.terms') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('terms') ? 'is-invalid' : '' }}" name="terms" id="terms">{!! old('terms', $event->terms) !!}</textarea>
                    @if($errors->has('terms'))
                        <span class="text-danger">{{ $errors->first('terms') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.terms_helper') }}</span>
                </div>               
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="required" for="last_booking_date">{{ trans('cruds.event.fields.last_booking_date') }}</label>
                  <input class="form-control date {{ $errors->has('last_booking_date') ? 'is-invalid' : '' }}" type="text" name="last_booking_date" id="last_booking_date" value="{{ old('last_booking_date', $event->last_booking_date) }}" required>
                  @if($errors->has('last_booking_date'))
                      <span class="text-danger">{{ $errors->first('last_booking_date') }}</span>
                  @endif
                  <span class="help-block">{{ trans('cruds.event.fields.last_booking_date_helper') }}</span>
                </div>
              </div>
              <div class="col-md-6">          
                <div class="form-group">
                    <label for="event_start_day">{{ trans('cruds.event.fields.event_start_day') }}</label>
                    <input class="form-control date {{ $errors->has('event_start_day') ? 'is-invalid' : '' }}" type="text" name="event_start_day" id="event_start_day" value="{{ old('event_start_day', $event->event_start_day) }}">
                    @if($errors->has('event_start_day'))
                        <span class="text-danger">{{ $errors->first('event_start_day') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.event_start_day_helper') }}</span>
                </div>
              </div>
            </div> 

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                    <label class="required" for="reporting_time">{{ trans('cruds.event.fields.reporting_time') }}</label>
                    <input class="form-control timepicker {{ $errors->has('reporting_time') ? 'is-invalid' : '' }}" type="text" name="reporting_time" id="reporting_time" value="{{ old('reporting_time', $event->reporting_time) }}" required>
                    @if($errors->has('reporting_time'))
                        <span class="text-danger">{{ $errors->first('reporting_time') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.reporting_time_helper') }}</span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label class="required" for="start_time">{{ trans('cruds.event.fields.start_time') }}</label>
                    <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time', $event->start_time) }}" required>
                    @if($errors->has('start_time'))
                        <span class="text-danger">{{ $errors->first('start_time') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.start_time_helper') }}</span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label for="end_time">{{ trans('cruds.event.fields.end_time') }}</label>
                    <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time', $event->end_time) }}">
                    @if($errors->has('end_time'))
                        <span class="text-danger">{{ $errors->first('end_time') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.event.fields.end_time_helper') }}</span>
                </div>
              </div>
            </div>
            
             
            <div class="form-group">
                <label for="location">{{ trans('cruds.event.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', $event->location) }}">
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.event.fields.event_type') }}</label>
                @foreach(App\Models\Event::EVENT_TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('event_type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="event_type_{{ $key }}" name="event_type" value="{{ $key }}" {{ old('event_type', $event->event_type) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="event_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('event_type'))
                    <span class="text-danger">{{ $errors->first('event_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.event_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.event.fields.is_cancelled') }}</label>
                @foreach(App\Models\Event::IS_CANCELLED_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_cancelled') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_cancelled_{{ $key }}" name="is_cancelled" value="{{ $key }}" {{ old('is_cancelled', $event->is_cancelled) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_cancelled_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_cancelled'))
                    <span class="text-danger">{{ $errors->first('is_cancelled') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.is_cancelled_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.event.fields.is_active') }}</label>
                @foreach(App\Models\Event::IS_ACTIVE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_active_{{ $key }}" name="is_active" value="{{ $key }}" {{ old('is_active', $event->is_active) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_active'))
                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.is_active_helper') }}</span>
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
    var uploadedEventImagesMap = {}
Dropzone.options.eventImagesDropzone = {
    url: '{{ route('admin.events.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="event_images[]" value="' + response.name + '">')
      uploadedEventImagesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedEventImagesMap[file.name]
      }
      $('form').find('input[name="event_images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($event) && $event->event_images)
      var files = {!! json_encode($event->event_images) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="event_images[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
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
                xhr.open('POST', '{{ route('admin.events.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $event->id ?? 0 }}');
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