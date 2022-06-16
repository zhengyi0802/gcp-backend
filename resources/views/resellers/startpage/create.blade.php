@extends('adminlte::page')

@section('title', __('startpages.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('startpages.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form name="startpage-new-form" action="{{ route('resellers.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
        <input type="hidden" name="p" value="startpage" >
        <input type="hidden" name="project_id" value="{{ $project_id }}" >
        <div class="card-group">
           <x-adminlte-input name="name" label="{{ __('startpages.name') }}" fgroup-class="col-md-12" />
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
            <x-adminlte-select name="mime_type" label="{{ __('startpages.mime_type') }}" fgroup-class="col-md-6"
             onchange="changeInput(this)" >
             <option value="image" selected>{{ __('startpages.type_image') }}</option>
             <option value="i_video" >{{ __('startpages.type_video') }}</option>
             <option value="e_video" >{{ __('startpages.type_external') }}</option>
             <option value="youtube" >{{ __('startpages.type_youtube') }}</option>
           </x-adminlte-select>
           <x-adminlte-card title="{{ __('startpages.url') }}" theme="teal" theme-mode="full" fgroup-class="col-md-6"
              icon="fas fa-lg fa-photo">
              <div id="upload-file">
                <x-adminlte-input-file name="file" accept="image/* videos/mp4" onChange="loadImage(event)" />
              </div>
              <div id="url-input" style="display:none">
                <x-adminlte-input name="url" fgroup-class="col-md-12" />
              </div>
              <div class="col-md-6" id="preview-image" >
                <img name="preview" id="preview" width="180" >
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
           <x-adminlte-input name="intervals"  label="{{ __('startpages.intervals') }}"
              type="number" fgroup-class="col-md-4" value="15" />
           <x-adminlte-input name="start_time" type="datetime" label="{{ __('startpages.start_time') }}"
             placeHolder="YYYY-MM-DD hh-mm-ss" fgroup-class="col-md-4" />
           <x-adminlte-input name="stop_time" type="datetime" label="{{ __('startpages.stop_time') }}"
             placeHolder="YYYY-MM-DD hh-mm-ss" fgroup-class="col-md-4" />
        </div>
        <div class="card-group">
           <x-adminlte-textarea name="description" label="{{ __('startpages.description') }}" rows=5 fgroup-class="col-md-12"
              igroup-size="sm" placeholder="Insert description...">
             <x-slot name="prependSlot">
               <div class="input-group-text bg-dark">
                 <i class="fas fa-lg fa-file-alt text-warning"></i>
               </div>
             </x-slot>
          </x-adminlte-textarea>
        </div>
        <div>
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}"
               onClick="window.location='{{ url()->previous(); }}'" />
        </div>
    </form>
@stop

