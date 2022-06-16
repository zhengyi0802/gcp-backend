@extends('adminlte::page')

@section('title', __('menus.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('menus.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('menus.name') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       <img src="{{ $menu->icon }}" width="64px" height="64px" >{{ $menu->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('menus.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ ($menu->project) ? $menu->project->name : null }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('menus.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $menu->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('menus.tag') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $menu->tag }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('menus.type') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $menu->type }}
      </x-adminlte-card>
      </div>
    </div>

    @if ($menu->upload)
    <div class="row col-12">
        <div class="card-group col-12">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('uploadfiles.show', $menu->upload->id) }}">{{ __('tables.fileinfo') }}>
            </div>
        </div>
    </div>
    @endif

@stop
