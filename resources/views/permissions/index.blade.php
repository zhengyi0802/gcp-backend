@extends('adminlte::page')

@section('title', __('users.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('users.page_header') }}</h1>
@stop

@section('messages')
      @if ($message = Session::get('success'))
      <x-adminlte-card title="{{ __('messages.success') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ $message }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('error'))
      <x-adminlte-card title="{{ __('messages.error') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ $message }}
      </x-adminlte-card>
      @endif
@stop

@section('content')
    <div class="row col-12">
      @yield('messages')
    </div>

    <div class="row col-12">
      @include('permissions.table')
    </div>

@stop

