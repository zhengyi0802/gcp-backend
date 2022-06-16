@extends('adminlte::page')

@section('title', __('bulletins.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('bulletins.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="bulletin-edit-form" action="{{ route('resellers.update', $bulletin->id) }}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PUT')\
    <input type="hidden" name="p" value="bulletin" >
    <div class="row col-12">
      <div class="card-group col-md-12">
           <label><h5>
             <input type="checkbox" name="popup" value="{{ $bulletin->popup }}">
             <span>{{ __('bulletins.popup') }}</span>
           </h5></label>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="title"  label="{{ __('bulletins.title') }}"
          fgroup-class="col-md-6" value="{{ $bulletin->title }}" />
        <x-adminlte-input name="message"  label="{{ __('bulletins.message') }}"
          fgroup-class="col-md-6" value="{{ $bulletin->message }}" />
        <x-adminlte-input name="date"  label="{{ __('bulletins.date') }}"
          fgroup-class="col-md-6" value="{{ $bulletin->date }}" />
      </div>
    </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ url()->previous(); }}'" />
    </div>
    </form>
@stop
