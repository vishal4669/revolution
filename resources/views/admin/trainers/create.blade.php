@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.trainer.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("trainers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.trainer.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trainer.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photo">{{ trans('cruds.trainer.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trainer.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="trainer_cost">{{ trans('cruds.trainer.fields.trainer_cost') }}</label>
                <input class="form-control {{ $errors->has('trainer_cost') ? 'is-invalid' : '' }}" type="number" name="trainer_cost" id="trainer_cost" value="{{ old('trainer_cost', '') }}" step="0.01" required>
                @if($errors->has('trainer_cost'))
                    <span class="text-danger">{{ $errors->first('trainer_cost') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trainer.fields.trainer_cost_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.trainer.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trainer.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.trainer.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Trainer::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '0') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trainer.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="serial_number">{{ trans('cruds.trainer.fields.serial_number') }}</label>
                <input class="form-control {{ $errors->has('serial_number') ? 'is-invalid' : '' }}" type="text" name="serial_number" id="serial_number" value="{{ old('serial_number', '') }}" required>
                @if($errors->has('serial_number'))
                    <span class="text-danger">{{ $errors->first('serial_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trainer.fields.serial_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rent_month">{{ trans('cruds.trainer.fields.rent_month') }}</label>
                <input class="form-control {{ $errors->has('rent_month') ? 'is-invalid' : '' }}" type="number" name="rent_month" id="rent_month" value="{{ old('rent_month', '3000') }}" step="1" required>
                @if($errors->has('rent_month'))
                    <span class="text-danger">{{ $errors->first('rent_month') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trainer.fields.rent_month_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rent_hour">{{ trans('cruds.trainer.fields.rent_hour') }}</label>
                <input class="form-control {{ $errors->has('rent_hour') ? 'is-invalid' : '' }}" type="number" name="rent_hour" id="rent_hour" value="{{ old('rent_hour', '200') }}" step="1" required>
                @if($errors->has('rent_hour'))
                    <span class="text-danger">{{ $errors->first('rent_hour') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trainer.fields.rent_hour_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.trainer.fields.is_active') }}</label>
                @foreach(App\Models\Trainer::IS_ACTIVE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_active') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_active_{{ $key }}" name="is_active" value="{{ $key }}" {{ old('is_active', '1') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="is_active_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_active'))
                    <span class="text-danger">{{ $errors->first('is_active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trainer.fields.is_active_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.trainer.fields.is_rented') }}</label>
                @foreach(App\Models\Trainer::IS_RENTED_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('is_rented') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="is_rented_{{ $key }}" name="is_rented" value="{{ $key }}" {{ old('is_rented', '0') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="is_rented_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('is_rented'))
                    <span class="text-danger">{{ $errors->first('is_rented') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trainer.fields.is_rented_helper') }}</span>
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
    var uploadedPhotoMap = {}
Dropzone.options.photoDropzone = {
    url: '{{ route('admin.trainers.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="photo[]" value="' + response.name + '">')
      uploadedPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotoMap[file.name]
      }
      $('form').find('input[name="photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($trainer) && $trainer->photo)
      var files = {!! json_encode($trainer->photo) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photo[]" value="' + file.file_name + '">')
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
                xhr.open('POST', '{{ route('admin.trainers.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $trainer->id ?? 0 }}');
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