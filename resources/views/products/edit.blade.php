@extends('adminlte::page')

@section('title', __('products.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('products.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="product-form" action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
       <x-adminlte-select name="type_id" label="{{ __('products.type') }}" fgroup-class="col-md-6" >
         @foreach($producttypes as $type)
         <option value="{{ $type->id }}" {{ ($product->type_id == $type->id) ? "selected" : null }} >{{ $type->name }}</option>
         @endforeach
       </x-adminlte-select>
       <x-adminlte-select name="project_id" label="{{ __('products.project') }}" fgroup-class="col-md-6" >
         @foreach($projects as $project)
         <option value="{{ $project->id }}" {{ ($product->project_id == $project->id) ? "selected" : null }}>{{ $project->name }}</option>
         @endforeach
       </x-adminlte-select>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="serialno" label="{{ __('products.serialno') }}" fgroup-class="col-md-4"
          value="{{ $product->serialno }}"  />
        <x-adminlte-input name="ether_mac" label="{{ __('products.ether_mac') }}" fgroup-class="col-md-4"
          value="{{ $product->ether_mac }}" />
        <x-adminlte-input name="wifi_mac" label="{{ __('products.wifi_mac') }}" fgroup-class="col-md-4"
          value="{{ $product->wifi_mac }}" />
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="expire_date" label="{{ __('products.expire_date') }}" fgroup-class="col-md-6"
          value="{{ $product->expire_date }}" />
       <x-adminlte-select name="status_id" label="{{ __('products.status') }}" fgroup-class="col-md-6" >
         @foreach($productstatuses as $status)
         <option value="{{ $status->id }}" {{ ($product->status_id == $status->id) ? "selected" : null }}>{{ $status->name }}</option>
         @endforeach
       </x-adminlte-select>
       </div>
    </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ route('products.index'); }}'" />
    </div>
    </form>
@stop

