@extends('adminlte::page')

@section('title', __('apkcatagories.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('apkcatagories.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('apkcatagories.name') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $apkcatagory->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apkcatagories.parent') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ ($apkcatagory->parent) ? $apkcatagory->parent->name : null }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apkcatagories.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $apkcatagory->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('apkcatagories.description') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        <p>{{ $apkcatagory->description }}</p>
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('apkcatagories.subcatagories') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        <table col="6" width="100%">
          @foreach($apkcatagory->childs->chunk(6) as $row)
          <tr>
            @foreach($row as $catagory)
            <td><a class="btn btn-info" href="{{ route('apkcatagories.show', $catagory->id) }}">{{ $catagory->name }}</a></td>
            @endforeach
          </tr>
          @endforeach
        </table>
      </x-adminlte-card>
      </div>
    </div>

    <div class="row col-12">
      @foreach($apkcatagory->apks->chunk(6) as $row)
      <div class="card-group col-md-12">
@php
  $i=0;
@endphp
        @foreach($row as $apk)
          <x-adminlte-card title="" fgroup-class="col-md-2" >
             <img src="{{ $apk->icon }}" width="90%"><br>
             {{ $apk->label }}<br>
             {{ $apk->package_version_name }}<br>
          </x-adminlte-card>
@php
  $i++;
@endphp
        @endforeach
        @for($j = $i; $j < 6; $j++)
          <x-adminlte-card title="" fgroup-class="col-md-2" >
          </x-adminlte-card>
        @endfor
      </div>
      @endforeach
    </div>
@stop
