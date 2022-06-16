@extends('adminlte::page')

@section('title', __('mediacatagories.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('mediacatagories.page_header') }}</h1>
@stop

@section('messages')
      @if ($message = Session::get('insert-success'))
      <x-adminlte-card title="{{ __('mediacatagories.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('mediacatagories.insert_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('insert-error'))
      <x-adminlte-card title="{{ __('mediacatagories.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('mediacatagories.insert_error') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-success'))
      <x-adminlte-card title="{{ __('mediacatagories.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('mediacatagories.update_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-error'))
      <x-adminlte-card title="{{ __('mediacatagories.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('mediacatagories.update_error') }}
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
                onClick="javascript:window.location='{{ route('mediacatagories.browse') }}';" />
            </div>
        </div>
    </div>

    @if (auth()->user()->canCreate(App\Enums\Content::Medias))
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('mediacatagories.create') }}">{{ __('tables.new') }}</a>
            </div>
        </div>
    </div>
    @endif

    <div class="row col-12" id="div-table">
      @include('mediacatagories.table')
    </div>

@stop
