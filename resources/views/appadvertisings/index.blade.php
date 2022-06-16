@extends('adminlte::page')

@section('title', __('appadvertisings.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('appadvertisings.page_header') }}</h1>
@stop

@section('messages')
      @if ($message = Session::get('insert-success'))
      <x-adminlte-card title="{{ __('appadvertisings.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('appadvertisings.insert_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('insert-error'))
      <x-adminlte-card title="{{ __('appadvertisings.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('appadvertisings.insert_error') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-success'))
      <x-adminlte-card title="{{ __('appadvertisings.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('appadvertisings.update_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-error'))
      <x-adminlte-card title="{{ __('appadvertisings.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('appadvertisings.update_error') }}
      </x-adminlte-card>
      @endif
@stop

@section('content')

    <div class="row col-12">
      @yield('messages')
    </div>

    <div class="row col-12">
        <div class="card">
            <div class="pull-right">
              <x-adminlte-button label="{{ __('tables.browse') }}"
                onClick="javascript:window.location='{{ route('appadvertisings.browse') }}';" />
            </div>
        </div>
    </div>

    @if (auth()->user()->canCreate(App\Enums\Content::AppMarketAdvertising))
        @include('appadvertisings.create')
    @endif

    <div class="row col-12" id="div-table">
      @include('appadvertisings.table')
    </div>

@stop


