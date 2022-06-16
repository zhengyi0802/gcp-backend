@extends('adminlte::page')

@section('title', __('onekeyinstallers.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('onekeyinstallers.page_header') }}</h1>
@stop

@section('messages')
      @if ($message = Session::get('insert-success'))
      <x-adminlte-card title="{{ __('onekeyinstallers.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('onekeyinstallers.insert_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('insert-error'))
      <x-adminlte-card title="{{ __('onekeyinstallers.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('onekeyinstallers.insert_error') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-success'))
      <x-adminlte-card title="{{ __('onekeyinstallers.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('onekeyinstallers.update_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-error'))
      <x-adminlte-card title="{{ __('onekeyinstallers.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('onekeyinstallers.update_error') }}
      </x-adminlte-card>
      @endif
@stop

@section('content')

    @if (auth()->user()->canCreate(App\Enums\Content::OneKeyInstaller))
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('onekeyinstallers.create') }}">{{ __('tables.new') }}</a>
            </div>
        </div>
    </div>
    @endif

    <div class="row col-12">
      @yield('messages')
    </div>

    <div class="row col-12">
      @include('onekeyinstallers.table')
    </div>

@stop


