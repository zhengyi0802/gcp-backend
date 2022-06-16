@extends('adminlte::page')

@section('title', __('bulletinitems.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('bulletinitems.page_header') }}</h1>
@stop

@section('content')

    @include('bulletinitems.create')

    <div class="row col-12">
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
    </div>

    <div class="row col-12">
      @include('bulletinitems.table')
    </div>
    {!! $bulletinitems->links(); !!}
@stop


