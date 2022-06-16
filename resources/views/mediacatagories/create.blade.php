@extends('adminlte::page')

@section('title', __('mediacatagories.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('mediacatagories.table_name').__('tables.new') }}</h1>
@stop

@section('content')
    <form id="mediacatagory-form" action="{{ route('mediacatagories.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-select id="menu_id" name="menu_id" label="{{ __('mediacatagories.option') }}"
             fgroup-class="col-md-4" onchange="changeMenu(this)">
             @foreach($menus as $menu)
             <option value="{{ $menu->id }}">{{ $menu->name }}</option>
             @endforeach
        </x-adminlte-select>
        <x-adminlte-select id="project_id" name="project_id" label="{{ __('mediacatagories.project') }}"
             fgroup-class="col-md-4"  onchange="changeGroup(this)">
             @foreach($projects as $project)
             <option value="{{ $project->id }}" {{ ($project->id == $project_id) ? "selected" : null }}>
             {{ $project->name }}
             </option>
             @endforeach
        </x-adminlte-select>
        @if ($parents != null)
        <x-adminlte-select name="parent_id" label="{{ __('mediacatagories.parent') }}"
             fgroup-class="col-md-4" >
             <option value="0" >{{ __('mediacatagories.parent_root') }}</option>
             @foreach($parents as $parent)
             <option value="{{ $parent->id }}">{{ $parent->name }}</option>
             @endforeach
        </x-adminlte-select>
        @endif
        <script>
            var changeGroup = function(select) {
                var menu_id = document.getElementById('menu_id').value;
                window.location.href='/mediacatagories/create?project_id=' + select.value + '&menu_id=' + menu_id;
            };
            var changeMenu = function(select) {
                var project_id = document.getElementById('project_id').value;
                window.location.href='/mediacatagories/create?project_id=' + project_id + '&menu_id=' + select.value;
            };
        </script>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-select name="type" label="{{ __('mediacatagories.type') }}" fgroup-class="col-md-6" >
             <option value="catagory" selected>{{ __('mediacatagories.type_catagory') }}</option>
             <option value="content">{{ __('mediacatagories.type_content') }}</option>
        </x-adminlte-select>
        <x-adminlte-input name="name" label="{{ __('mediacatagories.name') }}" fgroup-class="col-md-6" />
      </div>
    </div>
    <div class="row col-12">
        <div class="card-group col-md-12">
           <div class="card col-md-12">
           <img id="preview" theme="dark" width="320px" >
           <x-adminlte-input-file name="file" label="{{ __('mediacatagories.thumbnail') }}" onChange="loadImage(event)" />
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
        </div>
    </div>
    <div class="row col-12">
        <x-adminlte-textarea name="description" label="{{ __('mediacatagories.description') }}" rows=5 fgroup-class="col-md-12"
           igroup-size="sm" placeholder="Insert description...">
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
          onClick="window.location='{{ route('mediacatagories.index'); }}'" />
    </div>
    </form>
@stop
