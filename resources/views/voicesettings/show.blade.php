@extends('adminlte::page')

@section('title', __('voicesettings.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('voicesettings.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('voicesettings.keywords') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $voicesetting->keywords }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('voicesettings.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $voicesetting->project->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('voicesettings.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $voicesetting->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('voicesettings.label') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $voicesetting->apk->label }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('voicesettings.package') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $voicesetting->apk->package_name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('voicesettings.link_url') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $voicesetting->apk->path }}
      </x-adminlte-card>
      </div>
    </div>
@stop
