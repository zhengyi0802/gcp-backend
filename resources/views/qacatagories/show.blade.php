@extends('adminlte::page')

@section('title', __('qacatagories.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('qacatagories.table_name').__('tables.detail') }}</h1>
@stop

@section('content')
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('qacatagories.position') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $qacatagory->position }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('qacatagories.name') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $qacatagory->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('qacatagories.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $qacatagory->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('qacatagories.description') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        <p>{{ $qacatagory->description }}</p>
      </x-adminlte-card>
      </div>
    </div>
@stop
