@extends('adminlte::page')

@section('title', __('products.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('products.page_header') }}</h1>
@stop

@section('messages')
      @if ($message = Session::get('insert-success'))
      <x-adminlte-card title="{{ __('products.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('products.insert_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('insert-error'))
      <x-adminlte-card title="{{ __('products.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('products.insert_error') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-success'))
      <x-adminlte-card title="{{ __('products.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('products.update_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-error'))
      <x-adminlte-card title="{{ __('products.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('products.update_error') }}
      </x-adminlte-card>
      @endif
@stop

@section('content')

    @if (auth()->user()->role < App\Enums\UserRole::MainManager)
      @include('products.create')
    @endif

    <div class="row col-12">
      @yield('messages')
    </div>

    <div class="row col-12">
      @include('products.table')
    </div>

@stop


