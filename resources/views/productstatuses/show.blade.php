@extends('adminlte::page')

@section('title', __('productstatuses.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('productstatuses.table_name').__('tables.description') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('productstatuses.name') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $productstatus->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('productstatuses.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $productstatus->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <x-adminlte-card title="{{ __('productstatuses.description') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        <p>{{ $productstatus->description }}</p>
      </x-adminlte-card>
      </div>
    </div>
@stop
