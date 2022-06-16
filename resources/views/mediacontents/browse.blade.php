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

@section('browse')
    <div class="row col-12">
      @foreach ($mediacontents->chunk(4) as $row)
      <div class="card-group">
        @foreach ($row as $mediacontent)
          <x-adminlte-card title="{!! $mediacontent->name !!}" theme="purple" body-class="bg-black"
            icon="fas fa-lg fa-bell" >
            <img src="{!! $mediacontent->preview !!}" width="240px">
            <form name="mediacontent-delete-form" action="{{ route('mediacontents.destroy', $mediacontent->id); }}" method="POST">
            @csrf
            @method('DELETE')
              @if ($mediacontent->created_by != 2)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('mediacontents.edit', $mediacontent->id); }}'" >
              </x-adminlte-button>
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" >
              </x-adminlte-button>
              @endif
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('mediacontents.show', $mediacontent->id); }}'" >
              </x-adminlte-button>
            </form>
          </x-adminlte-card>
        @endforeach
      </div>
      @endforeach
    </div>
    {!! $mediacontents->links(); !!}
@stop

@section('content')

    <div class="row col-12">
      @yield('messages')
    </div>

    <div class="row col-12">
        <div class="card">
            <div class="pull-right">
              <x-adminlte-button label="{{ __('tables.lists') }}"
                onClick="javascript:window.location='{{ route('mediacontents.index') }}';" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('mediacontents.create') }}">{{ __('tables.new') }}</a>
            </div>
        </div>
    </div>

    <div class="row col-12" id="div-table">
      @yield('browse')
    </div>

@stop
