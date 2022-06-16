@extends('adminlte::page')

@section('title', __('startpages.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('startpages.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-md-12">
      <x-adminlte-card title="{{ __('startpages.name') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $startpage->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('startpages.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $startpage->creator->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('startpages.project') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $startpage->project->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
      <x-adminlte-card title="{{ __('startpages.url') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" theme-mode="full" icon-theme="white">
        @if ($startpage->mime_type == 'image')
            <img src="{{ $startpage->url }}" width="480px">
        @elseif ($startpage->mime_type == 'i_video' || $startpage->mime_type == 'e_video')
            <video width="480" controls>
                 <source src="{{ $startpage->url }}" type="video/mp4">
            </video>
        @else
            <x-embed-styles />
            <x-embed url="https://youtube.com/watch?v={{ $startpage->url }}" />
        @endif
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
      <x-adminlte-card title="{{ __('startpages.intervals') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         {{ $startpage->intervals }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
      <x-adminlte-card title="{{ __('startpages.start_time') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $startpage->start_time ? $startpage->start_time : __('times.started') }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('startpages.stop_time') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $startpage->stop_time ? $project->stop_time : __('times.endless') }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
      <x-adminlte-card title="{{ __('startpages.description') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        {{ $startpage->description }}
      </x-adminlte-card>
      </div>
    </div>
@stop
