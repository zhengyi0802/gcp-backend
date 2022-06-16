@extends('adminlte::page')

@section('title', __('businesses.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('businesses.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="business-edit-form" action="{{ route('businesses.update', $business->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-select name="project_id" label="{{ __('businesses.project') }}" fgroup-class="col-md-4" >
             <option value="0" disabled >{{ __('projects.select_one') }}</option>
             @foreach($projects as $project)
             <option value="{{ $project->id }}" {{ ($business->project_id == $project->id) ? "selected" : null }} >
               {{ $project->name }}
             </option>
             @endforeach
        </x-adminlte-select>
        <x-adminlte-input name="serial" label="{{ __('businesses.serial') }}" fgroup-class="col-md-4"
          value="{{ $business->serial }}" />
        <x-adminlte-input name="intervals"  label="{{ __('businesses.intervals') }}"
          fgroup-class="col-md-4" value="{{ $business->intervals }}" />
      </div>
    </div>
    <div class="row col-12">
        <div class="card-group col-md-12">
           <div class="card col-md-6">
           <img id="preview" theme="dark" width="320px" height="90px" src="{{ $business->logo_url }}" >
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
           <x-adminlte-input name="link_url"  label="{{ __('businesses.link_url') }}"
             fgroup-class="col-md-6" value="{{ $business->link_url }}" />
        </div>
    </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ route('businesses.index'); }}'" />
    </div>
    </form>
@stop

