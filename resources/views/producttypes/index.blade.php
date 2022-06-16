@extends('adminlte::page')

@section('title', __('producttypes.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('producttypes.page_header') }}</h1>
@stop

@section('messages')
      @if ($message = Session::get('insert-success'))
      <x-adminlte-card title="{{ __('producttypes.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('producttypes.insert_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('insert-error'))
      <x-adminlte-card title="{{ __('producttypes.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('producttypes.insert_error') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-success'))
      <x-adminlte-card title="{{ __('producttypes.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('producttypes.update_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-error'))
      <x-adminlte-card title="{{ __('producttypes.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('producttypes.update_error') }}
      </x-adminlte-card>
      @endif
@stop

@section('content')

    <div class="row col-12">
      @include('producttypes.treeview')
    </div>

    <div class="row col-12">
      @yield('messages')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('producttypes.table_name').__('tables.lists') }}" fgroup-class="col-md-12"
        icon="fas fa-lg fa-table text-primary" theme="danger" icon-theme="white" collapsible >
        @include('producttypes.table')
      </x-adminlte-card>
      </div>
    </div>

@stop


