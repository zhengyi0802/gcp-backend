@extends('adminlte::page')

@section('title', __('apkprograms.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('apkprograms.table_name').__('tables.detail') }}</h1>
@stop

@section('content')

    <div class="row col-12">
        @include('layouts.back')
    </div>

    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('apkprograms.label') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $apkprogram->label }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apkprograms.name') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $apkprogram->package_name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apkprograms.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $apkprogram->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('apkprograms.catagory') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $apkprogram->catagory->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apkprograms.icon') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         <img src="{{ $apkprogram->icon }}" width="128px" height="128px" >
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apkprograms.path') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $apkprogram->path }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('apkprograms.version_name') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         {{ $apkprogram->package_version_name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apkprograms.version_code') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         {{ $apkprogram->package_version_code }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apkprograms.sdk_version') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         {{ $apkprogram->sdk_version }}
      </x-adminlte-card>
       </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('apkprograms.types') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         <table cols="8" width="100%">
          @foreach($apkprogram->types()->chunk(8) as $chunk)
            <tr>
              @foreach($chunk as $type)
              <td>{{ $type->name }}</td>
              @endforeach
            </tr>
          @endforeach
         </table>
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apkprograms.projects') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         <table cols="8" width="100%">
          @foreach($apkprogram->projects()->chunk(8) as $chunk)
            <tr>
              @foreach($chunk as $project)
              <td>{{ $project->name }}</td>
              @endforeach
            </tr>
          @endforeach
         </table>
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apkprograms.macaddresses') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         <table cols="8" width="100%">
          @foreach($apkprogram->macaddresses() as $macaddress)
           <tr><td>{{ $macaddress }}</td></tr>
          @endforeach
         </table>
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('apkprograms.description') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        <p>{{ $apkprogram->description }}</p>
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('apkprograms.created_at') }}" fgroup-class="col-md-12"
         icon="fas fa-lg fa-bell text-primary" theme="info" icon-theme="white">
        <p>{{ $apkprogram->created_at }}</p>
      </x-adminlte-card>
      </div>
    </div>

@stop
