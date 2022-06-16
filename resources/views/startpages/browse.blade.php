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

@section('browse')
    <div class="row col-12">
      @foreach ($startpages->chunk(2) as $row)
      <div class="card-group">
        @foreach ($row as $startpage)
          <x-adminlte-card title="{!! $startpage->project->name !!}" theme="purple" body-class="bg-black"
            icon="fas fa-lg fa-bell" >
            @if ($startpage->mime_type == 'image')
                <img src="{{ $startpage->url }}" width="360px">
            @elseif ($startpage->mime_type == 'i_video' || $startpage->mime_type == 'e_video')
                <video width="360" controls>
                    <source src="{{ $startpage->url }}" type="video/mp4">
                </video>
            @else
                <x-embed url="https://youtube.com/watch?v={{ $startpage->url }}" />
            @endif
            <form name="startpage-delete-form" action="{{ route('startpages.destroy', $startpage->id); }}" method="POST">
            @csrf
            @method('DELETE')
              @if ($startpage->created_by != 2)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('startpages.edit', $startpage->id); }}'" >
              </x-adminlte-button>
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" >
              </x-adminlte-button>
              @endif
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('startpages.show', $startpage->id); }}'" >
              </x-adminlte-button>
            </form>
          </x-adminlte-card>
        @endforeach
      </div>
      @endforeach
    </div>
    {!! $startpages->links() !!}
@stop

@section('content')

    <div class="row col-12">
      @yield('message')
    </div>

    <div class="row col-12">
        <div class="card">
            <div class="pull-right">
              <x-adminlte-button label="{{ __('tables.lists') }}"
                onClick="javascript:window.location='{{ route('startpages.index') }}';" />
            </div>
        </div>
    </div>

    @include('startpages.create')

    <div class="row col-12" id="div-table">
      @yield('browse')
    </div>

@stop


