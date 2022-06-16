@extends('adminlte::page')

@section('title', __('products.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('products.table_name').__('tables.detail') }}</h1>
@stop

@section('logmessages')
        <div class="card">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('logmessages.browse', ['id' => $product->id]); }}">{{ __('products.logmessages') }}</a>
            </div>
        </div>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
        @yield('logmessages')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('products.serialno') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $product->serialno }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('products.ether_mac') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $product->ether_mac }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('products.wifi_mac') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $product->wifi_mac }}
      </x-adminlte-card>
      </div>
   </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('products.project') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $product->project->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('products.expire_date') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $product->expire_date }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('products.status') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $product->status->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('products.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $product->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
@php
$heads = [
    ['label' =>__('productrecords.index'), 'width' => 10],
    __('productrecords.created_by'),
    __('productrecords.data'),
    __('productrecords.result'),
    __('productrecords.created_time'),
];
$config = [
    'columns' => [null, ['orderable' => false], null, null, null],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
    <div class="row col-12">
      <div class="card-group col-12">
        <x-adminlte-card title="{{ __('products.records') }}" icon="fas fa-lg fa-cog text-primary"
          theme="teal" icon-theme="white"  collapsible >
          <x-adminlte-datatable id="product-record-table" :heads="$heads" :config="$config" theme="info" width="100%" striped hoverable>
            @foreach($product->records as $productrecord)
            <tr>
              <td>{!! $productrecord->id !!}</td>
              <td>{!! $productrecord->creator->name !!}</td>
              <td>{!! $productrecord->data !!}</td>
              <td>{!! $productrecord->result !!}</td>
              <td>{!! $productrecord->created_at !!}</td>
            </tr>
           @endforeach
          </x-adminlte-datatable>
        </x-adminlte-card>
      </div>
    </div>
@stop
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
