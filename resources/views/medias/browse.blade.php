@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('mediacontents.page_title') }}</h1>
@stop

@section('content')
    <div class="row col-12">
      <div class="card-group col-md-12">
          <x-adminlte-select id="project" name="project" label="{{ __('mediacatagories.project') }}" fgroup-class="col-md-6" >
            @foreach($projects as $project)
              <option value="{{ $project->id }}" {{ (isset($project_id) && ($project_id == $project->id)) ? "selected" : null }} >
                {{ $project->name }}
              </option>
            @endforeach
          </x-adminlte-select>
          <x-adminlte-select id="menu" name="menu" label="{{ __('mediacatagories.option') }}" fgroup-class="col-md-6" >
            @foreach($menus as $menu)
              <option value="{{ $menu->id }}" {{ (isset($menu_id) && ($menu_id == $menu->id)) ? "selected" : null }} >
                {{ $menu->name }}
              </option>
            @endforeach
          </x-adminlte-select>
          <script>
              document.getElementById('project').addEventListener('change',  function() {
                  window.location = '/medias/browse?project_id=' + this.value;
              }, false);
              document.getElementById('menu').addEventListener('change',  function() {
                  var project_id = document.getElementById('project').value;
                  window.location = '/medias/browse?project_id=' + project_id + '&menu_id=' + this.value;
              }, false);
          </script>
    </div>
    <div class="row col-12">
        @if ($parent != null)
        <div class="card">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('medias.browse', ['group_id' => $group_id, 'menu_id' => $menu_id, 'id' => $parent_id]); }}">
                  {{ $parent }}
                </a>
            </div>
        </div>
        @endif
    </div>
    <div class="row col-12">
      @foreach ($medias->chunk(4) as $row)
      <div class="card-group col-md-12">
        @foreach ($row as $media)
          <x-adminlte-card title="{!! $media->name !!}" theme="purple" body-class="bg-black"
            icon="fas fa-lg fa-bell" fgroup-class="col-md-3">
            @if ($media->type != null)
                <img src="{!! $media->thumbnail !!}" style="width: 100%;"
                     onclick="next({{ $media->id}} , {{$media->parent_id }})" >
            @elseif ($media->preview)
                <video width="100%" height="100%" poster="{{ $media->preview }}" controls>
                     <source src="{{ $media->url }}" type="video/mp4">
                </video>
            @else
                <img src="" style="width: 100%;" >
            @endif
            <p>{{ $media->name }}</p>
          </x-adminlte-card>
        @endforeach
      </div>
      @endforeach

      <script>
          function next(id, parent_id) {
              var project_id = document.getElementById('project').value;
              var menu_id = document.getElementById('menu').value;
              var location = '/medias/browse?project_id=' + project_id + '&menu_id=' + menu_id + '&id=' + id;
              location = location + '&parent_id=' + parent_id;
              //alert(location);
              window.location = location;
          }
      </script>
    </div>
    {{ $medias->links(); }}
@stop
