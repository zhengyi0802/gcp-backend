@extends('adminlte::page')

@section('title', __('menus.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('menus.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="menu-edit-form" action="{{ route('resellers.update', $menu->id) }}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <input name="p" value="menu" type="hidden" >
      </div>
      <div class="card-group col-md-12">
        <x-adminlte-input name="name" label="{{ __('menus.name') }}" fgroup-class="col-md-6"
          value="{{ $menu->name }}" disabled />
        <x-adminlte-select name="type" label="{{ __('menus.type') }}" fgroup-class="col-md-6" >
             <option value="video" {{ ($menu->type == "video") ? "selected" : null }} >{{ __('menus.type_video') }}</option>
        </x-adminlte-select>
      </div>
    </div>
    <div class="row col-12">
        <div class="card-group col-md-12">
           <div class="card col-md-6">
           <img id="preview" theme="dark" width="160px" height="160px" src="{{ $menu->icon }}" >
           <x-adminlte-input-file name="file" label="{{ __('menus.icon') }}" onChange="loadImage(event)" />
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
           <x-adminlte-input name="tag"  label="{{ __('menus.tag') }}"
             fgroup-class="col-md-6" value="{{ $menu->tag }}" />
        </div>
    </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ url()->previous(); }}'" />
    </div>
    </form>
@stop

