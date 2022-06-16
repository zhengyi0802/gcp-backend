@extends('adminlte::page')

@section('title', __('resellers.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('advertisings.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="advertising-edit-form" action="{{ route('resellers.update', $advertising->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <input name="p" value="advertising" "hidden" >
        <x-adminlte-input name="index" label="{{ __('adverrtisings.index2') }}" fgroup-class="col-md-6"
          value="{{ $advertising->index }}" />
      </div>
    </div>
    <div class="row col-12">
        <div class="card-group col-md-12">
           <div class="card col-md-6">
           <img id="preview" theme="dark" width="320px" src="{{ $advertising->thumbnail }}" >
           <x-adminlte-input-file name="file" label="{{ __('advertisings.thumbnail') }}" onChange="loadImage(event)" />
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
           <x-adminlte-input name="link_url"  label="{{ __('businesses.link_url') }}"
             fgroup-class="col-md-6" value="{{ $advertising->link_url }}" />
        </div>
    </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ url()->previous(); }}'" />
    </div>
    </form>
@stop

