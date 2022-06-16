@extends('adminlte::page')

@section('title', __('resellers.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('resellers.page_header') }}</h1>
@stop

@section('content')
    <x-adminlte-select id="project" name="project" label="{{ __('appmenus.project') }}" fgroup-class="col-md-6"
      onchange="">
      @foreach($projects as $project)
      <option value="{{ $project->id }}" {{ (isset($project_id) && ($project_id == $project->id)) ? "selected" : null }} >
        {{ $project->name }}
      </option>
      @endforeach
    </x-adminlte-select>
    <script>
        document.getElementById('project').addEventListener('change',  function() {
            window.location = 'resellers?project_id=' + this.value;
        }, false);
    </script>

     <div class="row col-12">
        <div class="card-group col-md-12">
          @include('resellers.layouts.startpage')
        </div>
     </div>
     <div class="row col-12">
        <div class="card-group col-md-12">
          <div class="col-md-6">
            @include('resellers.layouts.business')
          </div>
          <div class="col-md-6">
            @include('resellers.layouts.advertising')
          </div>
        </div>
        <div class="card-group col-md-12">
          <div class="col-md-6">
            @include('resellers.layouts.mainvideo')
          </div>
          <div class="col-md-6">
            @include('resellers.layouts.bulletin')
          </div>
        </div>
        <div class="card-group col-md-12">
          <div class="col-md-6">
            @include('resellers.layouts.menus')
          </div>
          <div class="col-md-6">
            @include('resellers.layouts.appmenu')
          </div>
        </div>
        <div class="card-group col-md-12">
          <div class="col-md-12">
            @include('resellers.layouts.marquee')
          </div>
        </div>
     </div>
     @include('resellers.layouts.mediacatagories')
@stop
