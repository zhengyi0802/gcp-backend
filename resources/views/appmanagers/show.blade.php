@extends('adminlte::page')

@section('title', __('appmanagers.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('appmanagers.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('appmanagers.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $appmanager->project->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('appmanagers.package') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ ($appmanager->apk) ? $appmanager->apk->label : null }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('appmanagers.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $appmanager->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('apkprograms.name') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ ($appmanager->apk) ? $appmanager->apk->package_name : null }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('appmanagers.icon') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       @if ($appmanager->apk)
         <img src="{{ $appmanager->apk->icon }}" width="128px">
       @endif
      </x-adminlte-card>
      </div>
    </div>
@stop
