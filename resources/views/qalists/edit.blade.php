@extends('adminlte::master')

@section('body')
    <form name="qalist-edit-form" action="{{ route('qalists.update', $qalist->id) }}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="card-group col-md-12">
        <input name="catagory_id" value="{{ $qalist->catagory_id }}" hidden />
        <x-adminlte-input name="question" label="{{ __('qalists.question') }}"
           value="{{ $qalist->question }}" />
        @if (auth()->user()->canAudit(App\Enums\Content::QA))
        <x-adminlte-input-switch name="audit" label="{{ __('tables.audit') }}" checked />
        @endif
        <x-adminlte-select name="type" label="{{ __('qalists.type') }}" onchange="changeInput(this)" >
          <option value="image" {{ ($qalist->type == 'image') ? "selected" : null  }}>{{ __('startpages.type_image') }}</option>
          <option value="i_video" {{ ($qalist->type == 'i_video') ? "selected" : null  }}>{{ __('startpages.type_video') }}</option>
          <option value="e_video" {{ ($qalist->type == 'e_video') ? "selected" : null  }}>{{ __('startpages.type_external') }}</option>
          <option value="youtube" {{ ($qalist->type == 'youtube') ? "selected" : null  }}>{{ __('startpages.type_youtube') }}</option>
        </x-adminlte-select>
    </div>
    <div class="card-group">
      <script>
          var changeInput = function(select) {
                if (select.value == 'image') {
                    //alert(document.getElementById('url-input').style);
                    document.getElementById('url-input').style.display='none';
                    document.getElementById('upload-file').style.display='';
                    document.getElementById('preview-image').style.display='';
                } else if (select.value == "i_video") {
                    document.getElementById('url-input').style.display='none';
                    document.getElementById('upload-file').style.display='';
                    document.getElementById('preview-image').style.display='none';
                } else {
                    document.getElementById('url-input').style.display='';
                    document.getElementById('upload-file').style.display='none';
                    document.getElementById('preview-image').style.display='none';
                }
          };
      </script>
      <x-adminlte-card title="{{ __('qalists.answer') }}" theme="teal" theme-mode="full" fgroup-class="col-md-6"
        icon="fas fa-lg fa-photo">
        <div id="upload-file">
          <x-adminlte-input-file name="file" accept="image/* videos/mp4" onChange="loadImage(event)" />
        </div>
        <div id="url-input" style="display:none">
          <x-adminlte-input name="url" fgroup-class="col-md-12" value="{{ $qalist->answer }}"/>
        </div>
        <div class="col-md-6" id="preview-image" >
          <img name="preview" id="preview" width="180" src="{{ $qalist->answer }}" >
        </div>
      </x-adminlte-card>
      <script>
          var loadImage = function(event) {
                var output = document.getElementById('preview');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
          };
      </script>
    </div>
    <div class="card-group">
       <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
       <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"/>
    </div>
    </form>
@stop
@section('plugins.BootstrapSwitch', true)
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function() {
          var val = $('#type').val();
          if (val == 'image') {
              $('#url-input').hide();
              $('#upload-file').show();
              $('#preview-image').show();
          } else if (val == "i_video") {
              $('#url-input').hide();
              $('#upload-file').show();
              $('#preview-image').hide();
          } else {
              $('#url-input').show();
              $('#upload-file').hide();
              $('#preview-image').hide();
          }

    });
</script>
