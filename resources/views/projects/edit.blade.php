@extends('adminlte::page')

@section('title', __('projects.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('projects.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
@php
$sconfig = [
    'onColor' => 'orange',
    'offColor' => 'dark',
    'inverse' => true,
    'animate' => false,
    'state' => true,
    'labelText' => '<i class="fas fa-2x fa-fw fa-lightbulb text-orange"></i>',
];
@endphp
    <form id="project-form" action="{{ route('projects.update', $project->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="name" label="{{ __('projects.name') }}" fgroup-class="col-md-6"
          value="{{ $project->name }}" disabled />
        <x-adminlte-input name="company" label="{{ __('projects.company') }}" fgroup-class="col-md-6"
          value="{{ $project->company }}" />
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="start_time" label="{{ __('projects.start_time') }}" fgroup-class="col-md-6"
          value="{{ $project->start_time }}" />
        <x-adminlte-input name="stop_time" label="{{ __('projects.stop_time') }}" fgroup-class="col-md-6"
          value="{{ $project->stop_time }}" />
      </div>
    </div>
    <div class="row col-12">
        <x-adminlte-textarea name="description" label="{{ __('projects.description') }}" rows=5 fgroup-class="col-md-12"
           igroup-size="sm" placeholder="Insert description...">{{ $project->description }}
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
          onClick="window.location='{{ route('projects.index'); }}'" />
    </div>
    </form>
@stop
@section('plugins.BootstrapSwitch', true)
