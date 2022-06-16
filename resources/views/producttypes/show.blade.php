@extends('adminlte::page')

@section('title', __('producttypes.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('producttypes.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        <div class="card">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('producttypes.index') }}">{{ __('tables.back') }}</a>
            </div>
        </div>
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('producttypes.name') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $producttype->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('producttypes.catagory') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       <a class="btn btn-success" href="{{ route('productcatagories.show', $producttype->catagory->id); }}">{{ $producttype->catagory->name }}</a>
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('producttypes.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $producttype->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row card-group col-md-12">
      <x-adminlte-card title="{{ __('producttypes.description') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        <p>{{ $producttype->description }}</p>
      </x-adminlte-card>
      </div>
    </div>
    <div class="row card-group col-md-12">
      <x-adminlte-card title="{{ __('producttypes.products') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white"  collapsible >
         @include('producttypes.products')
      </x-adminlte-card>
      </div>
    </div>
@stop
