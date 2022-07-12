@extends('adminlte::page')

@section('title', __('apkprograms.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('apkprograms.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="apkprogram-edit-form" action="{{ route('apkprograms.update', $apkprogram->id) }}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="label" label="{{ __('apkprograms.label') }}" fgroup-class="col-md-12"
          value="{{ $apkprogram->label }}" disabled />
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
           <x-adminlte-select id="catagory_id" name="catagory_id" label="{{ __('apkprograms.catagory') }}"
             fgroup-class="col-md-12" >
             @foreach($catagories as $catagory)
             <option value="{{ $catagory->id }}" {{ ($catagory->id == $apkprogram->catagory_id) ? "selected" : null }} >
             {{ $catagory->name }}
             </option>
             @endforeach
           </x-adminlte-select>
      </div>
    </div>
<!--
    <div class="row col-12">
      <div class="card-group col-md-12">
        @include('apkprograms.listprojects')
      </div>
      <div class="card-group col-md-12">
        @include('apkprograms.listtypes')
      </div>
    </div>
-->
    <div class="row col-12">
       <x-adminlte-textarea name="mac_addresses" label="{{ __('apkprograms.macaddresses') }}" rows=5 fgroup-class="col-md-12"
           igroup-size="sm" >
          <x-slot name="prependSlot">
            <div class="input-group-text bg-dark">
              <i class="fas fa-lg fa-file-alt text-warning"></i>
            </div>
          </x-slot>
       </x-adminlte-textarea>
    </div>
    <div class="row col-12">
        <x-adminlte-textarea name="description" label="{{ __('apkprograms.description') }}" rows=5 fgroup-class="col-md-12"
           igroup-size="sm" placeholder="Insert description...">{{ $apkprogram->description }}
          <x-slot name="prependSlot">
            <div class="input-group-text bg-dark">
              <i class="fas fa-lg fa-file-alt text-warning"></i>
            </div>
          </x-slot>
       </x-adminlte-textarea>
    </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ route('apkprograms.index'); }}'" />
    </div>
    </form>
@stop
