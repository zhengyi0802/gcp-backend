@extends('adminlte::page')

@section('title', __('onekeyinstallers.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('onekeyinstallers.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('onekeyinstallers.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $onekeyinstaller->project->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apkprograms.label') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ ($onekeyinstaller->apk) ? $onekeyinstaller->apk->label : null }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('onekeyinstallers.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $onekeyinstaller->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('apkprograms.name') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ ($onekeyinstaller->apk) ? $onekeyinstaller->apk->package_name : null }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('onekeyinstallers.icon') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       @if ($onekeyinstaller->apk)
         <img src="{{ $onekeyinstaller->apk->icon }}" width="128px">
       @endif
      </x-adminlte-card>
      </div>
    </div>
@stop
