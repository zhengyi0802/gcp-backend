@extends('adminlte::page')

@section('title', __('marquees.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('marquees.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="marquee-edit-form" action="{{ route('marquees.update', $marquee->id) }}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="name" label="{{ __('marquees.name') }}" fgroup-class="col-md-6"
          value="{{ $marquee->name }}" disabled />
        <x-adminlte-select name="project_id" label="{{ __('marquees.project') }}" fgroup-class="col-md-6" >
             @foreach($projects as $project)
             <option value="{{ $project->id }}" {{ ($marquee->project_id == $project->id) ? "selected" : null }} >
               {{ $project->name }}
             </option>
             @endforeach
        </x-adminlte-select>
        <x-adminlte-select name="type" label="{{ __('marquees.type') }}" fgroup-class="col-md-6" >
             <option value="1" {{ ($marquee->type == "1") ? "selected" : null }} >{{ __('marquees.type_product') }}</option>
             <option value="2" {{ ($marquee->type == "2") ? "selected" : null }} >{{ __('marquees.type_project') }}</option>
             <option value="3" {{ ($marquee->type == "3") ? "selected" : null }} >{{ __('marquees.type_all') }}</option>
        </x-adminlte-select>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="content" label="{{ __('marquees.content') }}" fgroup-class="col-md-6" value="{{ $marquee->content }}" />
        <x-adminlte-input name="url" label="{{ __('marquees.url') }}" fgroup-class="col-md-6" value="{{ $marquee->url }}" />
      </div>
    </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ route('marquees.index'); }}'" />
    </div>
    </form>
@stop

