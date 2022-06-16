@extends('adminlte::page')

@section('title', __('marquees.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('marquees.page_header') }}</h1>
@stop

@section('messages')
      @if ($message = Session::get('insert-success'))
      <x-adminlte-card title="{{ __('marquees.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('marquees.insert_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('insert-error'))
      <x-adminlte-card title="{{ __('marquees.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('marquees.insert_error') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-success'))
      <x-adminlte-card title="{{ __('marquees.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('marquees.update_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-error'))
      <x-adminlte-card title="{{ __('marquees.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('marquees.update_error') }}
      </x-adminlte-card>
      @endif
@stop

@section('content')

    @if (auth()->user()->canCreate(App\Enums\Content::Marquee))
        @include('marquees.create')
    @endif

    <div class="row col-12">
      @yield('messages')
    </div>

    <div class="row col-12">
      @include('marquees.table')
    </div>

@stop


