@extends('adminlte::page')

@section('title', __('bulletinitems.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('bulletinitems.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-md-12">
      <x-adminlte-card title="{{ __('bulletinitems.bulletin') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $bulletinitem->bulletin->title.'('. $bulletinitem->bulletin->date.')' }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('bulletinitems.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $bulletinitem->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
      <x-adminlte-card title="{{ __('bulletinitems.url') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" theme-mode="full" icon-theme="white">
        @if ($bulletinitem->mime_type == 'image')
            <img src="{{ $bulletinitem->url }}" width="360px">
        @elseif ($bulletinitem->mime_type == 'i_video')
            <video width="360" controls>
                 <source src="{{ $bulletinitem->url }}" type="video/mp4">
            </video>
        @else
            {{ $bulletinitem->url }}
        @endif
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('bulletinitems.url_http') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $bulletinitem->url_http }}
      </x-adminlte-card>
      </div>
    </div>
@stop
