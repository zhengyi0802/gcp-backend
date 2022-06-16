@extends('adminlte::page')

@section('title', __('appmenus.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('appmenus.page_header') }}</h1>
@stop

@section('content')
    <x-adminlte-select id="project" name="project" label="{{ __('appmenus.project') }}" fgroup-class="col-md-6"
      onchange="">
      @foreach($projects as $project)
      <option value="{{ $project->id }}" >{{ $project->name }}</option>
      @endforeach
    </x-adminlte-select>
    <script>
        document.getElementById('project').addEventListener('change',  function() {
            //document.getElementById('project_id').value = this.value;
            //document.getElementById('projectname').innerHTML = this.selectedOptions[0].text;
            window.location = 'appmenus?project=' + this.value;
        }, false);
    </script>

    <div class="row">
      <div class="card-group col-md-12">
         <div class="card col-md-6">
            @include('appmenus.table')
         </div>
         <div class="card col-md-6">
            <iframe id="details" name="details" height="480px" allow-forms ></iframe>
         </div>
      </div>
    </div>
@stop

