@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('frontendviews.page_title') }}</h1>
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
            window.location = 'frontendviews?project_id=' + this.value;
        }, false);
    </script>

    <div class="row col-12">
        <div class="card-group col-md-12" style="height:80px">
          <div class="card col-md-3">
             @include('frontendviews.logo')
          </div>
          <div class="card col-md-6">
             @include('frontendviews.top_marquee')
          </div>
          <div class="card col-md-3">
             @include('frontendviews.date')
          </div>
        </div>
        <div class="card-group col-md-12" style="height:340px">
          <div class="card col-md-3">
             @include('frontendviews.businesses')
             @include('frontendviews.advertisings')
          </div>
          <div class="card col-md-6">
             @include('frontendviews.mainvideos')
          </div>
          <div class="card col-md-3">
             @include('frontendviews.bulletins')
             <div class="card" style="height:220px;" >
               @include('frontendviews.appmenus')
             </div>
          </div>
        </div>
        <div class="card-group col-md-12" style="height:80px;">
          <div class="card col-md-3">
             @include('frontendviews.menus')
          </div>
          <div class="card col-md-6">
             @include('frontendviews.bottom_marquee')
          </div>
          <div class="card col-md-3">
             @include('frontendviews.status')
          </div>
        </div>
    </div>
    <div class="col-12">
      @include('frontendviews.startpage')
    </div>
    <script>
      function editLogo() {
         var project_id = document.getElementById('project').value;
         window.location = '/resellers/create?p=logo&project_id=' + project_id;
      }
      function editMarquee(position) {
      }
      function editBusiness() {
         var project_id = document.getElementById('project').value;
         //alert('project '+ project_id + ' business');
         window.location = '/resellers/create?p=business&project_id=' + project_id;
      }
      function editAdvertising() {
         var project_id = document.getElementById('project').value;
         window.location = '/resellers/create?p=advertising&project_id=' + project_id;
      }
      function editMainVideo() {
         var project_id = document.getElementById('project').value;
         window.location = '/resellers/create?p=mainvideo&project_id' + project_id;
      }
      function editBulletin() {
         var project_id = document.getElementById('project').value;
         window.location = '/resellers/create?p=bulletin&project_id=' + project_id;
      }
      function editApp(position) {
         var project_id = document.getElementById('project').value;
         windows.location = '/resellers/creare?p=appmenu?project_id=' + project_id + '&position=' + position;
      }
      function editMenu() {
         var project_id = document.getElementById('project').value;
         window.location = '/resellers/create?p=menu&project_id=' + project_id;
      }
    </script>
@stop
