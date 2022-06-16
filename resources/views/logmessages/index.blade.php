@extends('adminlte::page')

@section('title', __('logmessages.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('logmessages.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('logmessages.title') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('logmessages.create') }}">{{ __('tables.new') }}</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row col-12">
      @include('logmessages.table')
    </div>

@endsection
