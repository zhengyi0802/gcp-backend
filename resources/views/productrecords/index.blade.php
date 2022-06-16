@extends('adminlte::page')

@section('title', __('productrecords.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('productrecords.page_header') }}</h1>
@stop

@section('table_config')
@php
$heads = [
    ['label' => __('productrecords.index'), 'width' => '10%'],
    ['label' => __('productrecords.created_by'), 'width' => '10%'],
    ['label' => __('productrecords.data'), 'width' => '60%'],
    ['label' => __('productrecords.result'), 'width' => '10%'],
    ['label' => __('productrecords.created_time'), 'width' => '10%'],
];
$config = [
    'columns' => [null, null, null, null, null],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
@stop

@section('content')

    @yield('table_config')

    <div class="row col-md-12">
      <x-adminlte-datatable id="table3" :heads="$heads" :config="$config" theme="info" width="100%" striped hoverable>
         @foreach($productrecords as $productrecord)
           <tr>
             <td>{!! $productrecord->id !!}</td>
             <td>{!! $productrecord->creator->name !!}</td>
             <td>{!! $productrecord->data !!}</td>
             <td>{!! $productrecord->result !!}</td>
             <td>{!! $productrecord->created_at !!}</td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
    </div>
@stop
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
