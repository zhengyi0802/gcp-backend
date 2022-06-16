@extends('adminlte::page')

@section('title', __('bulletins.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('bulletins.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('bulletins.popup') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $bulletin->popup ? __('bulletins.popup_yes') : __('bulletins.popup_no') }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('bulletins.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $bulletin->project->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('bulletins.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $bulletin->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('bulletins.title') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $bulletin->title }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('bulletins.message') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $bulletin->message }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('bulletins.date') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $bulletin->date }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
        @include('bulletinitems.create')
        @include('bulletinitems.table')
      </div>
    </div>
@stop
