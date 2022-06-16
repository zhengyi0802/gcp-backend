@extends('adminlte::page')

@section('title', __('apitests.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('apitests.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('apitests.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $apitest->project->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apitests.key') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $apitest->key }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apitests.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $apitest->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('apitests.type') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        @if ($apitest->type == 'string')
            {{ __('apitests.type_string') }}
        @elseif ($apitest->type == 'jason')
            {{ __('apitests.type_jason') }}
        @elseif ($apitest->type == 'plaintext')
            {{ __('apitests.type_text') }}
        @endif
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apitests.value') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        <p>{{ $apitest->value }}</p>
      </x-adminlte-card>
      </div>
      </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('apitests.memo') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        <p>{{ $apitest->memo }}</p>
      </x-adminlte-card>
      </div>
    </div>
@stop
