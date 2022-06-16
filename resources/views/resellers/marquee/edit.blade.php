@extends('adminlte::page')

@section('title', __('marquees.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('marquees.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="marquee-edit-form" action="{{ route('resellers.update', $marquee->id) }}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <input name="p" value="marquee" type="hidden" >
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="name" label="{{ __('marquees.name') }}" fgroup-class="col-md-6"
          value="{{ $marquee->name }}" disabled />
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="content" label="{{ __('marquees.content') }}" fgroup-class="col-md-12" value="{{ $marquee->content }} " />
      </div>
    </div>
    <div class="rol col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="url" label="{{ __('marquees.url') }}" fgroup-class="col-md-12" value="{{ $marquee->url }}" />
      </div.
    </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ url()->previous(); }}'" />
    </div>
    </form>
@stop

