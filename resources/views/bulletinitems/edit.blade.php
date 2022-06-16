@extends('adminlte::page')

@section('title', __('bulletinitems.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('bulletinitems.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="bulletinitem-form" action="{{ route('bulletinitems.update', $bulletinitem->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12" >
      <input type="hidden" name="bulletin_id" value="{{ $bulletinitem->bulletin->id }}" >
      <x-adminlte-input type="text" name="bulletin" label="{{ __('bulletinitems.bulletin') }}" fgroup-class="col-md-12"
           value="{{ $bulletinitem->bulletin->title.'('.$bulletinitem->bulletin->date.')' }}" disabled />
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
            <x-adminlte-select name="mime_type" label="{{ __('bulletinitems.mime_type') }}" fgroup-class="col-md-6"
             onchange="changeInput(this)" >
             <option value="image" {{ ($bulletinitem->mime_type == "image") ? "selected" : null }} >{{ __('bulletinitems.type_image') }}</option>
             <option value="i_video" {{ ($bulletinitem->mime_type == "i_video") ? "selected" : null }} >{{ __('bulletinitems.type_video') }}</option>
             <option value="e_video" {{ ($bulletinitem->mime_type == "e_video") ? "selected" : null }} >{{ __('bulletinitems.type_external') }}</option>
             <option value="youtube" {{ ($bulletinitem->mime_type == "youtube") ? "selected" : null }} >{{ __('bulletinitems.type_youtube') }}</option>
           </x-adminlte-select>
           <x-adminlte-card title="{{ __('bulletinitems.url') }}" theme="teal" theme-mode="full" fgroup-class="col-md-6"
              icon="fas fa-lg fa-photo">
              <div id="upload-file">
                <x-adminlte-input-file name="file" accept="image/* video/mp4" onChange="loadImage(event)" />
              </div>
              <div id="url-input" style="display:none">
                <x-adminlte-input name="url" fgroup-class="col-md-12" value="{{ $bulletinitem->url }}" />
              </div>
              <div id="preview-image" class="col-md-6" >
                <img name="preview" id="preview" width="180" src="{{ $bulletinitem->url }}" >
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
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ route('bulletins.show', $bulletinitem->bulletin->id); }}'" />
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
