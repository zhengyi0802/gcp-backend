@extends('adminlte::page')

@section('title', __('projects.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('projects.page_header') }}</h1>
@stop

@section('messages')
      @if ($message = Session::get('insert-success'))
      <x-adminlte-card title="{{ __('projects.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('projects.insert_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('insert-error'))
      <x-adminlte-card title="{{ __('projects.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('projects.insert_error') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('insert-error1'))
      <x-adminlte-card title="{{ __('projects.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('projects.insert_error1') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-success'))
      <x-adminlte-card title="{{ __('projects.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('projects.update_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-error'))
      <x-adminlte-card title="{{ __('projects.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('projects.update_error') }}
      </x-adminlte-card>
      @endif
@stop

@section('content')

    @if (auth()->user()->canCreate(App\Enums\Content::Project))
        @include('projects.create')
    @endif

    <div class="row col-12">
      @yield('messages')
    </div>

    <div class="row col-12">
      @include('projects.table')
    </div>
@stop


