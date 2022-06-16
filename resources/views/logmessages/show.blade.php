@extends('adminlte::page')

@section('title', __('logmessages.title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('logmessages.header') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>{{ __('tables.detail') }}</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ url()->previous() }}">{{ __('tables.back') }}</a>
            </div>
            <div class="pull-right">
                <!-- <a class="btn btn-success" href="{{ route('logmessages.create') }}">{{ __('tables.new') }}</a> -->
                <h4>{{ __('logmessages.product') }} : {{ ($logmessage->product) ? $logmessage->product->id : '0' }}</h4>
            </div>
        </div>
    </div>

    <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.timestamp') }} :</strong>
                {{ $logmessage->timestamp }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.version_code') }} :</strong>
                {{ $logmessage->version_code }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.version_name') }} :</strong>
                {{ $logmessage->version_name }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.android') }} :</strong>
                {{ $logmessage->android }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.mac_eth') }} :</strong>
                {{ $logmessage->ether }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.mac_wifi') }} :</strong>
                {{ $logmessage->wifi }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.sn') }} :</strong>
                {{ $logmessage->serialno }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.created_at') }} :</strong>
                {{ $logmessage->created_at }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.action') }} :</strong>
                {{ $logmessage->action }}
            </div>
         </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>{{ __('logmessages.data') }} :</strong>
                {{ $logmessage->data }}
            </div>
         </div>
     </div>
@endsection
