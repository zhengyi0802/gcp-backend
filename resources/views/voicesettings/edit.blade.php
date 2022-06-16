@extends('adminlte::page')

@section('title', __('voicesettings.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('voicesettings.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="voicesetting-edit-form" action="{{ route('voicesettings.update', $voicesetting->id) }}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="keywords" label="{{ __('voicesettings.keywords') }}" fgroup-class="col-md-6"
          value="{{ $voicesetting->keywords }}" disabled />
        <x-adminlte-select name="project_id" label="{{ __('voicesettings.project') }}" fgroup-class="col-md-6" >
             <option value="0" disabled >{{ __('projects.select_one') }}</option>
             @foreach($projects as $project)
             <option value="{{ $project->id }}" {{ ($voicesetting->project_id == $project->id) ? "selected" : null }} >
               {{ $project->name }}
             </option>
             @endforeach
        </x-adminlte-select>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-select name="apk_id" label="{{ __('hotapps.package') }}" fgroup-class="col-md-4" >
             @foreach($apks as $apk)
             <option value="{{ $apk->id }}" {{ ($apk->id == $voicesetting->apk->id) ? "selected" : null }}>{{ $apk->label }}</option>
             @endforeach
        </x-adminlte-select>
      </div>
    </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ route('voicesettings.index'); }}'" />
    </div>
    </form>
@stop

