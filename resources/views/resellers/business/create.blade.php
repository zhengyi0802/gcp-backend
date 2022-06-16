@extends('adminlte::page')

@section('title', __('resellers.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('resellers.page_header') }}</h1>
@stop

@section('content')
    <form name="business-new-form" action="{{ route('resellers.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
        <div class="card-group">
           <input name="p" value="business" type="hidden" >
           <input name="project_id" value="{{ $project_id }}" type="hidden" >
           <x-adminlte-input name="serial"  label="{{ __('businesses.serial') }}"
             fgroup-class="col-md-6" placeHolder="0" />
           <x-adminlte-input name="intervals"  label="{{ __('businesses.intervals') }}"
             fgroup-class="col-md-6" value="15" />
        </div>
        <div class="card-group">
           <div class="card col-md-6">
           <img id="preview" width="320px" height="90px" theme="dark" >
           <x-adminlte-input-file name="file" label="{{ __('businesses.logo_url') }}" onChange="loadImage(event)" />
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
           <x-adminlte-input name="link_url"  label="{{ __('logos.link_url') }}"
             fgroup-class="col-md-6" />
        </div>
        <div class="card-group">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" 
              onclick="window.location='{{ url()->previous(); }}';" />
        </div>
    </form>
@stop
