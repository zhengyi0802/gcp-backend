@extends('adminlte::page')

@section('title', __('customersupports.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('customersupports.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="customersupport-edit-form" action="{{ route('customersupports.update', $customersupport->id) }}" 
        method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-select name="project_id" label="{{ __('customersupports.project') }}" fgroup-class="col-md-6" >
             @foreach($projects as $project)
             <option value="{{ $project->id }}" {{ ($customersupport->project_id == $project->id) ? "selected" : null }} >
               {{ $project->name }}
             </option>
             @endforeach
        </x-adminlte-select>
        <x-adminlte-select name="qrcode_type" label="{{ __('customersupports.qrcode_type') }}" 
             fgroup-class="col-md-6" onchange="changeInput(this)">
             <option value="image" {{ ($customersupport->qrcode_type == "image") ? "selected" : null }} >
                {{ __('customersupports.type_image') }}
             </option>
             <option value="text" {{ ($customersupport->qrcode_type == "text") ? "selected" : null }} >
                {{ __('customersupports.type_text') }}
             </option>
             <option value="none" {{ ($customersupport->qrcode_type == "none") ? "selected" : null }} >
                {{ __('customersupports.type_none') }}
             </option>
        </x-adminlte-select>
        <script>
            var changeInput = function(select) {
                   if (select.value == 'image') {
                       document.getElementById('div-image').style.display="";
                       document.getElementById('div-text').style.display="none";
                   } else if (select.value == 'text') {
                       document.getElementById('div-image').style.display="none";
                       document.getElementById('div-text').style.display="";
                   } else {
                       document.getElementById('div-image').style.display="none";
                       document.getElementById('div-text').style.display="none";
                   }
               };
        </script>
      </div>
    </div>
    <div class="row col-12">
        <div class="card-group col-md-12" id="div-image" >
           <img id="preview" theme="dark" width="320px" height="90px" src="{{ $customersupport->qrcode_content }}" >
           <x-adminlte-input-file name="file" label="{{ __('customersupports.qrcode_content') }}" onChange="loadImage(event)" />
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
       <div class="card-group col-md-12" id="div-text" style="display:none">
           <x-adminlte-input name="qrcode_content"  label="{{ __('customersupports.qrcode_content') }}"
             fgroup-class="col-md-6" value="{{ $customersupport->qrcode_content }}" />
        </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
         <x-adminlte-input name="message"  label="{{ __('customersupports.message') }}"
            fgroup-class="col-md-6" value="{{ $customersupport->message }}" />
         <x-adminlte-select name="apk_id" label="{{ __('customersupports.rcapp') }}" fgroup-class="col-md-6" >
            @foreach($apks as $apk)
            <option value="{{ $apk->id }}" {{ ($customersupport->apk_id == $apk->id) ? "selected" : null  }} >
            {{ $apk->label }}
            </option>
            @endforeach
         </x-adminlte-select>
      </div>
    </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ route('customersupports.index'); }}'" />
    </div>
    </form>
@stop
