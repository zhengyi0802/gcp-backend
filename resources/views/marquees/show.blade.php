@extends('adminlte::page')

@section('title', __('marquees.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('marquees.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('marquees.type') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       @if ($marquee->type == '1')
           {{ __('marquees.type_product') }}
       @elseif ($marquee->type == '2')
           {{ __('marquees.type_project') }}
       @elseif ($marquee->type == '3')
           {{ __('marquees.type_all') }}
       @endif
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('marquees.name') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $marquee->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('marquees.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ ($marquee->project) ? $marquee->project->name : null }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('marquees.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $marquee->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('marquees.content') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $marquee->content }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('marquees.url') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $marquee->url }}
      </x-adminlte-card>
      </div>
    </div>
@stop
