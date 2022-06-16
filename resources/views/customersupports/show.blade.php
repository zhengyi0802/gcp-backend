@extends('adminlte::page')

@section('title', __('customersupports.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('customersupports.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('customersupports.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $customersupport->project->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('customersupports.qrcode_type') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       @if ($customersupport->qrcode_type == 'image')
           {{ __('customersupports.type_image') }}
       @elseif ($customersupport->qrcode_type == 'text')
           {{ __('customersupports.type_text') }}
       @else
           {{ __('customersupports.type_none') }}
       @endif
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('customersupports.qrcode_content') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       @if ($customersupport->qrcode_type == 'image')
           <img src="{{ $customersupport->qrcode_content }}" width="320px">
       @else
           {{ $customersupport->qrcode_content }}
       @endif
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('customersupports.message') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         {{ $customersupport->message }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('customersupports.created_by') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $customersupport->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('customersupports.rcapp') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         {{ $customersupport->apk->package_name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('customersupports.rcapp_label') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $customersupport->apk->label }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('customersupports.rcapp_url') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $customersupport->apk->path }}
      </x-adminlte-card>
      </div>
    </div>

@stop
