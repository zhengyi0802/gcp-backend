@extends('adminlte::page')

@section('title', __('appadvertisings.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('appadvertisings.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('appadvertisings.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $appadvertising->project->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('appadvertisings.interval') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $appadvertising->interval }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('appadvertisings.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $appadvertising->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('appadvertisings.thumbnail') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         <img src="{{ $appadvertising->thumbnail }}" width="320px" >
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('appadvertisings.link_url') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $appadvertising->link_url }}
      </x-adminlte-card>
      </div>
    </div>

@stop
