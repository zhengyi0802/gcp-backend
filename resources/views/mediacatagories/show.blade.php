@extends('adminlte::page')

@section('title', __('mediacatagories.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('mediacatagories.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('mediacatagories.option') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $mediacatagory->menu->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('mediacatagories.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $mediacatagory->project->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('mediacatagories.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $mediacatagory->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('mediacatagories.type') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ ($mediacatagory->type == 'catagory') ? __('mediacatagories.type_catagory') : __('mediacatagories.type_content') }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('mediacatagories.parent') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ ($mediacatagory->parent_id > 0) ?$mediacatagory->parent->name : __('mediacatagories.parent_root') }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('mediacatagories.name') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $mediacatagory->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('mediacatagories.thumbnail') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        <img src="{{ $mediacatagory->thumbnail }}" width="90%" >
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('mediacatagories.created_by') }}" fgroup-class="col-md-12"
       icon="fas fa-lg fa-table text-primary" theme="danger" icon-theme="white">
       {{ $mediacatagory->creator->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('mediacatagories.description') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        <p>{{ $mediacatagory->description }}</p>
      </x-adminlte-card>
      </div>
    </div>

@stop
