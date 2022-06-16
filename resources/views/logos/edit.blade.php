@extends('adminlte::page')

@section('title', __('logos.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('logos.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="logo-edit-form" action="{{ route('logos.update', $logo->id) }}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="name" label="{{ __('logos.name') }}" fgroup-class="col-md-6"
          value="{{ $logo->name }}" disabled />
        <x-adminlte-select name="project_id" label="{{ __('logos.project') }}" fgroup-class="col-md-6" >
             <option value="0" disabled >{{ __('projects.select_one') }}</option>
             @foreach($projects as $project)
             <option value="{{ $project->id }}" {{ ($logo->project_id == $project->id) ? "selected" : null }} >
               {{ $project->name }}
             </option>
             @endforeach
        </x-adminlte-select>
      </div>
    </div>
    <div class="row col-12">
        <div class="card-group col-md-12">
           <div class="card col-md-6">
           <img id="preview" theme="dark" width="320px" height="90px" src="{{ $logo->image }}" >
           <x-adminlte-input-file name="file" label="{{ __('logos.image') }}" onChange="loadImage(event)" />
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
             fgroup-class="col-md-6" value="{{ $logo->link_url }}" />
        </div>
    </div>
    <div class="row col-12">
        <x-adminlte-textarea name="description" label="{{ __('logos.description') }}" rows=5 fgroup-class="col-md-12"
           igroup-size="sm" placeholder="Insert description...">{{ $logo->description }}
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
          onClick="window.location='{{ route('logos.index'); }}'" />
    </div>
    </form>
@stop

