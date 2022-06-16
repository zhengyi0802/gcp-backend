@extends('adminlte::page')

@section('title', __('customersupports.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('customersupports.page_header') }}</h1>
@stop

@section('messages')
      @if ($message = Session::get('insert-success'))
      <x-adminlte-card title="{{ __('customersupports.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('customersupports.insert_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('insert-error'))
      <x-adminlte-card title="{{ __('customersupports.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('customersupports.insert_error') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-success'))
      <x-adminlte-card title="{{ __('customersupports.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('customersupports.update_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-error'))
      <x-adminlte-card title="{{ __('customersupports.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('customersupports.update_error') }}
      </x-adminlte-card>
      @endif
@stop

@section('content')

    @include('customersupports.create')

    <div class="row col-12">
      @yield('messages')
    </div>

    <div class="row col-12">
      @include('customersupports.table')
    </div>
@stop


