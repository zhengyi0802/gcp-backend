@extends('adminlte::page')

@section('title', __('mediacontents.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('mediacontents.page_header') }}</h1>
@stop

@section('messages')
      @if ($message = Session::get('insert-success'))
      <x-adminlte-card title="{{ __('mediacontents.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('mediacontents.insert_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('insert-error'))
      <x-adminlte-card title="{{ __('mediacontents.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('mediacontents.insert_error') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-success'))
      <x-adminlte-card title="{{ __('mediacontents.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('mediacontents.update_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-error'))
      <x-adminlte-card title="{{ __('mediacontents.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('mediacontents.update_error') }}
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
                onClick="javascript:window.location='{{ route('mediacontents.browse') }}';" />
            </div>
        </div>
    </div>

    @if (auth()->user()->canCreate(App\Enums\Content::Medias))
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('mediacontents.create') }}">{{ __('tables.new') }}</a>
            </div>
        </div>
    </div>
    @endif

    <div class="row col-12" id="div-table">
      @include('mediacontents.table')
    </div>

@stop
