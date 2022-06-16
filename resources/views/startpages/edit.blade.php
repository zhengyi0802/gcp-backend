@extends('adminlte::page')

@section('title', __('startpages.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('startpages.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="startpage-form" action="{{ route('startpages.update', $startpage->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12" >
        <x-adminlte-input name="name" label="{{ __('startpages.name') }}" fgroup-class="col-md-6"
          value="{{ $startpage->name }}" disabled/>
      </div>
    </div>
    <div class="row col-12">
        <div class="card-group col-md-12">
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
            <x-adminlte-select id="mime_type" name="mime_type" label="{{ __('startpages.mime_type') }}" fgroup-class="col-md-6"
             onchange="changeInput(this)" >
             <option value="image" {{ ($startpage->mime_type == "image") ? "selected" : null }} >{{ __('startpages.type_image') }}</option>
             <option value="i_video" {{ ($startpage->mime_type == "i_video") ? "selected" : null }} >{{ __('startpages.type_video') }}</option>
             <option value="e_video" {{ ($startpage->mime_type == "e_video") ? "selected" : null }} >{{ __('startpages.type_external') }}</option>
             <option value="youtube" {{ ($startpage->mime_type == "youtube") ? "selected" : null }} >{{ __('startpages.type_youtube') }}</option>
           </x-adminlte-select>
           <x-adminlte-card title="{{ __('startpages.url') }}" theme="teal" theme-mode="full" fgroup-class="col-md-6"
              icon="fas fa-lg fa-photo">
              <div id="upload-file">
                <x-adminlte-input-file name="file" accept="image/* video/mp4" onChange="loadImage(event)" />
              </div>
              <div id="url-input" style="display:none">
                <x-adminlte-input name="url" fgroup-class="col-md-12" value="{{ $startpage->url }}" />
              </div>
              <div id="preview-image" class="col-md-6" >
                <img name="preview" id="preview" width="180" src="{{ $startpage->url }}" >
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
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12" >
        <x-adminlte-input name="intervals" label="{{ __('startpages.intervals') }}" fgroup-class="col-md-4"
          value="{{ $startpage->intervals }}" />
        <x-adminlte-input name="start_time" type="datetime" label="{{ __('startpages.start_time') }}"
          value="{{ $startpage->start_time }}" fgroup-class="col-md-4" />
        <x-adminlte-input name="stop_time" type="datetime" label="{{ __('startpages.stop_time') }}"
          value="{{ $startpage->stop_time }}" fgroup-class="col-md-4" />
      </div>
    </div>
    <div class="row col-12">
        <x-adminlte-textarea name="description" label="{{ __('startpages.description') }}" rows=5 fgroup-class="col-md-12"
           igroup-size="sm" placeholder="Insert description...">{{ $startpage->description }}
          <x-slot name="prependSlot">
            <div class="input-group-text bg-dark">
              <i class="fas fa-lg fa-file-alt text-warning"></i>
            </div>
          </x-slot>
       </x-adminlte-textarea>
     </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ route('startpages.index'); }}'" />
    </div>
    </form>
@stop
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function() {
          var val = $('#mime_type').val();
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
