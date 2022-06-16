@extends('adminlte::page')

@section('title', __('businesses.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('businesses.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('businesses.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $business->project->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('businesses.serial') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $business->serial }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('businesses.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $business->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
      <x-adminlte-card title="{{ __('businesses.logo_url') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white" fgroup-class="col-md-4">
         <img src="{{ $business->logo_url }}" width="320px" >
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('businesses.link_url') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white" fgroup-class="col-md-4">
        {{ $business->link_url }}
      </x-adminlte-card>
      </div>
      <x-adminlte-card title="{{ __('businesses.intervals') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white" fgroup-class="col-md-4">
       {{ $business->intervals }}
      </x-adminlte-card>
    </div>

@stop
