@extends('adminlte::page')

@section('title', __('mediacontents.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('mediacontents.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('mediacontents.catagory') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $mediacontent->catagory->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('mediacontents.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $mediacontent->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('mediacontents.name') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $mediacontent->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('mediacontents.preview') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        <img src="{{ $mediacontent->preview }}" width="90%">
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('mediacontents.mime_type') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        @if ($mediacontent->mime_type == 'i_video')
            {{ __('mediacontents.type_video') }}
        @elseif ($mediacontent->mime_type == 'e_video')
            {{ __('mediacontents.type_external') }}
        @elseif ($mediacontent->mime_type == 'youtube')
            {{ __('mediacontents.type_youtube') }}
        @endif
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('mediacontents.url') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         @if ($mediacontent->mime_type == 'i_video')
            <video width="360px" controls>
                 <source src="{{ $mediacontent->url }}" type="video/mp4" >
            </video>
         @else
            {{ $mediacontent->url }}
         @endif
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('mediacontents.created_by') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-table text-primary" theme="danger" icon-theme="white">
         {{ $mediacontent->creator->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('mediacontents.description') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        <p>{{ $mediacontent->description }}</p>
      </x-adminlte-card>
      </div>
    </div>
@stop
