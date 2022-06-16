@extends('adminlte::page')

@section('title', __('logos.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('logos.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('logos.name') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $logo->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('logos.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $logo->project->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('logos.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $logo->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('logos.image') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         <img src="{{ $logo->image }}" width="320px" height="120px" >
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('logos.link_url') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $logo->link_url }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('logos.description') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        <p>{{ $logo->description }}</p>
      </x-adminlte-card>
      </div>
    </div>
    @if ($logo->upload)
    <div class="row col-12">
        <div class="card-group col-12">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('uploadfiles.show', $logo->upload->id) }}">{{ __('tables.fileinfo') }}</a>
            </div>
        </div>
    </div>
    @endif
@stop
