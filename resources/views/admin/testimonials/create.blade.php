@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.testimonial.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.testimonials.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.testimonial.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    <option> Please select user </option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->full_name }}</option>
                            @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="testimonial">{{ trans('cruds.testimonial.fields.testimonial') }}</label>
                <textarea class="form-control {{ $errors->has('testimonial') ? 'is-invalid' : '' }}" name="testimonial" id="testimonial" required>{{ old('testimonial') }}</textarea>
                @if($errors->has('testimonial'))
                    <span class="text-danger">{{ $errors->first('testimonial') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.testimonial_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_photo">{{ trans('cruds.testimonial.fields.user_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('user_photo') ? 'is-invalid' : '' }}" id="user_photo-dropzone">
                </div>
                @if($errors->has('user_photo'))
                    <span class="text-danger">{{ $errors->first('user_photo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.user_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_visible') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="is_visible" id="is_visible" value="1" required {{ old('is_visible', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="is_visible">{{ trans('cruds.testimonial.fields.is_visible') }}</label>
                </div>
                @if($errors->has('is_visible'))
                    <span class="text-danger">{{ $errors->first('is_visible') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.testimonial.fields.is_visible_helper') }}</span>
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
    Dropzone.options.userPhotoDropzone = {
    url: '{{ route('admin.testimonials.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="user_photo"]').remove()
      $('form').append('<input type="hidden" name="user_photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="user_photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($testimonial) && $testimonial->user_photo)
      var file = {!! json_encode($testimonial->user_photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="user_photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
@endsection