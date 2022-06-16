@extends('adminlte::page')

@section('title', __('productcatagories.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('productcatagories.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        <div class="card">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('productcatagories.index') }}">{{ __('tables.back') }}</a>
            </div>
        </div>
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('productcatagories.name') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $productcatagory->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('productcatagories.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $productcatagory->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-card title="{{ __('productcatagories.description') }}" fgroup-class="col-md-12"
           icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
           <p>{{ $productcatagory->description }}</p>
        </x-adminlte-card>
      </div>
    </div>

    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-card title="{{ __('productcatagories.types') }}" fgroup-class="col-md-12"
          icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
          <table col="6" width="100%">
             @foreach($productcatagory->producttypes->chunk(6) as $result)
             <tr>
                @foreach($result as $type)
                  <td><a class="btn btn-success" href="{{ route('producttypes.show', $type->id); }}">{{ $type->name }}</a></td>
                @endforeach
             </tr>
             @endforeach
          </table>
        </x-adminlte-card>
      </div>
    </div>
@stop
