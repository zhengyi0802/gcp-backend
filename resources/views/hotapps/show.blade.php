@extends('adminlte::page')

@section('title', __('hotapps.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('hotapps.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('hotapps.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $hotapp->project->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apkprograms.label') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ ($hotapp->apk) ? $hotapp->apk->label : null }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('hotapps.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $hotapp->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('apkprograms.name') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ ($hotapp->apk) ? $hotapp->apk->package_name : null }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('hotapps.icon') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       @if ($hotapp->apk)
         <img src="{{ $hotapp->apk->icon }}" width="128px">
       @endif
      </x-adminlte-card>
      </div>
    </div>
@stop
