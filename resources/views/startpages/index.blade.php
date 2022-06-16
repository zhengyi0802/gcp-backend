@extends('adminlte::page')

@section('title', __('startpages.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('startpages.page_header') }}</h1>
@stop

@section('message')
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
      @yield('message')
    </div>

    <div class="row col-12">
        <div class="card">
            <div class="pull-right">
              <x-adminlte-button label="{{ __('tables.browse') }}"
                onClick="javascript:window.location='{{ route('startpages.browse') }}';" />
            </div>
        </div>
    </div>

    @if (auth()->user()->canCreate(App\Enums\Content::Startpage))
        @include('startpages.create')
    @endif

    <div class="row col-12" id="div-table">
      @include('startpages.table')
    </div>

@stop

