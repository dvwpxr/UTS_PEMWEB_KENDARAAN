@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.kendaraan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kendaraans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">{{ trans('cruds.kendaraan.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.kendaraan.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.kendaraan.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.kendaraan.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="text" name="price" id="price" value="{{ old('price', '') }}" step="0.01">
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mesin">{{ trans('cruds.kendaraan.fields.mesin') }}</label>
                <input class="form-control {{ $errors->has('mesin') ? 'is-invalid' : '' }}" type="text" name="mesin" id="mesin" value="{{ old('mesin', '') }}" step="0.01">
                @if($errors->has('mesin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mesin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.mesin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fitur">{{ trans('cruds.kendaraan.fields.fitur') }}</label>
                <input class="form-control {{ $errors->has('fitur') ? 'is-invalid' : '' }}" type="text" name="fitur" id="fitur" value="{{ old('fitur', '') }}" step="0.01">
                @if($errors->has('fitur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fitur') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kendaraan.fields.fitur_helper') }}</span>
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
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.kendaraans.storeMedia') }}',
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
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($kendaraan) && $kendaraan->image)
      var file = {!! json_encode($kendaraan->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
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