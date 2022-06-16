@extends('adminlte::page')

@section('title', __('advertisings.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('advertisings.table_name').__('tables.detail') }}</h1>
@stop

@section('content')
    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('advertisings.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $advertising->project->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('advertisings.index2') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $advertising->index }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('advertisings.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $advertising->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('advertisings.thumbnail') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         <img src="{{ $advertising->thumbnail }}" width="320px" >
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('advertisings.link_url') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $advertising->link_url }}
      </x-adminlte-card>
      </div>
    </div>

@stop
