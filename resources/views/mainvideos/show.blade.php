@extends('adminlte::page')

@section('title', __('mainvideos.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('mainvideos.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-card title="{{ __('mainvideos.project') }}" icon="fas fa-lg fa-cog text-primary"
           theme="teal" icon-theme="white" fgroup-class="col-md-4">
           {{ $mainvideo->project->name }}
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('mainvideos.type') }}" icon="fas fa-lg fa-cog text-primary"
           theme="teal" icon-theme="white" fgroup-class="col-md-4">
               @if ($mainvideo->type == 'playlist')
               {{ __('mainvideos.type_playlist') }}
               @elseif ($mainvideo->type == 'youtube_playlist')
               {{ __('mainvideos.type_youtube_playlist') }}
               @elseif ($mainvideo->type == 'youtube_playlist_id')
               {{ __('mainvideos.type_youtube_playlist_id') }}
               @elseif ($mainvideo->type == 'stream')
               {{ __('mainvideos.type_stream') }}
               @endif
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('mainvideos.created_by') }}" icon="fas fa-lg fa-cog text-primary"
           theme="teal" icon-theme="white" fgroup-class="col-md-4">
           {{ $mainvideo->creator->name }}
        </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
      <x-adminlte-card title="{{ __('mainvideos.playlist') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        <pre>{{ $mainvideo->playlists() }}</pre>
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('mainvideos.playlist') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         <x-embed url="{{ $mainvideo->firstvideo() }}" />
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
      <x-adminlte-card title="{{ __('mainvideos.description') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        <pre>{{ $mainvideo->description }}</pre>
      </x-adminlte-card>
      </div>
    </div>
@stop
