@extends('adminlte::page')

@section('title', __('appmanagers.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('appmanagers.page_header') }}</h1>
@stop

@section('messages')
      @if ($message = Session::get('insert-success'))
      <x-adminlte-card title="{{ __('appmanagers.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('appmanagers.insert_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('insert-error'))
      <x-adminlte-card title="{{ __('appmanagers.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('appmanagers.insert_error') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-success'))
      <x-adminlte-card title="{{ __('appmanagers.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('appmanagers.update_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-error'))
      <x-adminlte-card title="{{ __('appmanagers.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('appmanagers.update_error') }}
      </x-adminlte-card>
      @endif
@stop

@section('content')

    @if (auth()->user()->canCreate(App\Enums\Content::AppMarket))
        @include('appmanagers.create')
    @endif

    <div class="row col-12">
      @yield('messages')
    </div>

    <div class="row col-12">
        @include('appmanagers.table')
    </div>
@stop
@section('plugins.BootstrapSwitch', true)
