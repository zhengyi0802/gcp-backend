@extends('adminlte::page')

@section('title', __('mediacontents.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('mediacontents.table_name').__('tables.new') }}</h1>
@stop

@section('content')
    <form id="mediacontent-form" action="{{ route('mediacontents.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-select name="catagory_id" label="{{ __('mediacontents.catagory') }}"
             fgroup-class="col-md-6">
             @foreach($mediacatagories as $mediacatagory)
             <option value="{{ $mediacatagory->id }}">{{ $mediacatagory->name }}</option>
             @endforeach
        </x-adminlte-select>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="name" label="{{ __('mediacontents.name') }}" fgroup-class="col-md-12" />
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-select name="mime_type" label="{{ __('mediacontents.mime_type') }}"
          fgroup-class="col-md-6" onchange="changeType(this)">
             <option value="i_video" selected>{{ __('mediacontents.type_video') }}</option>
             <option value="e_video">{{ __('mediacontents.type_external') }}</option>
             <option value="youtube">{{ __('mediacontents.type_youtube') }}</option>
        </x-adminlte-select>
        <div class="col-md-6" id="div-upload">
           <x-adminlte-input-file name="video" label="{{ __('mediacontents.url') }}" onChange="loadImage(event)" />
        </div>
        <div class="col-md-6" id="div-upload" style="display:none".
           <x-adminlte-input name="url" label="{{ __('mediacontents.url') }}" onChange="loadImage(event)" />
        </div>
        <script>
            var changeType = function(select) {
                if (select.value == 'i_video') {
                    document.getElementById('div-upload').style.display = '';
                    document.getElementById('div-input').style.display = 'none';
                } else {
                    document.getElementById('div-upload').style.display = 'none';
                    document.getElementById('div-input').style.display = '';
                }
            };
        </script>
      </div>
    </div>
    <div class="row col-12">
        <div class="card-group col-md-12">
           <div class="card col-md-12">
           <img id="preview" theme="dark" width="320px" >
           <x-adminlte-input-file name="image" title="{{ __('mediacontents.preview') }}" onChange="loadImage(event)" />
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
    </div>
    <div class="row col-12">
        <x-adminlte-textarea name="description" label="{{ __('mediacontents.description') }}" rows=5 fgroup-class="col-md-12"
           igroup-size="sm" placeholder="Insert description...">
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
          onClick="window.location='{{ route('mediacontents.index'); }}'" />
    </div>
    </form>
@stop
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function() {
          var val = $('#mime_type').val();
          if (val == "i_video") {
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

