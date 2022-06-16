@extends('adminlte::page')

@section('title', __('projects.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('projects.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('projects.name') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $project->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('projects.company') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $project->company }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('projects.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $project->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('projects.start_time') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $project->start_time ? $project->start_time : __('times.started') }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('projects.stop_time') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $project->stop_time ? $project->stop_time : __('times.endless') }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('projects.status') }}" fgroup-class="col-md-12"
       icon="fas fa-lg fa-table text-primary" theme="danger" icon-theme="white">
       {{ $project->status ? __('status.enabled'):__('status.disabled') }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('projects.description') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        <p>{{ $project->description }}</p>
      </x-adminlte-card>
      </div>
    </div>
@stop
