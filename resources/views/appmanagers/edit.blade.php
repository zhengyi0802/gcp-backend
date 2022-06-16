@extends('adminlte::page')

@section('title', __('appmanagers.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('appmanagers.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="appmanager-form" action="{{ route('appmanagers.update', $appmanager->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-select name="project_id" label="{{ __('appmanagers.project') }}" fgroup-class="col-md-6" >
             @foreach($projects as $project)
             <option value="{{ $project->id }}" {{ ($appmanager->project_id == $project->id) ? "selected" : null }} >
               {{ $project->name }}
             </option>
             @endforeach
        </x-adminlte-select>
        <x-adminlte-select name="apk_id" label="{{ __('appmanagers.package') }}" fgroup-class="col-md-4" >
             @foreach($apks as $apk)
             <option value="{{ $apk->id }}" {{ ($appmanager->apk_id == $apk->id) ? "selected" : null }} >
               {{ $apk->name }}
             </option>
             @endforeach
        </x-adminlte-select>
      </div>
    </div>
    <div class="row col-12">
        <x-adminlte-textarea name="description" label="{{ __('appmanagers.description') }}" rows=5 fgroup-class="col-md-12"
           igroup-size="sm" placeholder="Insert description...">{{ $appmanager->description }}
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
          onClick="window.location='{{ route('appmanagers.index'); }}'" />
    </div>
    </form>
@stop

