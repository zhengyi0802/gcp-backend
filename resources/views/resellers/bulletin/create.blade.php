@extends('adminlte::page')

@section('title', __('bulletins.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('bulletins.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form name="bulletin-new-form" action="{{ route('resellers.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <input type="hidden" name="p" value="bulletin" >
    <input type="hidden" name="project_id" value="{{ $project_id }}" >
        <div class="card-group">
           <label><h5>
             <input type="checkbox" name="popup" >
             <span>{{ __('bulletins.popup') }}</span>
           </h5></label>
         </div>
        <div class="card-group">
           <x-adminlte-input name="title"  label="{{ __('bulletins.title') }}"
             fgroup-class="col-md-6" />
           <x-adminlte-input name="message"  label="{{ __('bulletins.message') }}"
             fgroup-class="col-md-6" />
           <x-adminlte-input name="date"  label="{{ __('bulletins.date') }}"
             fgroup-class="col-md-6" />
        </div>
        <div class="card-group">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}"
              onClick="window.location='{{ url()->previous(); }}'" />
        </div>
    </form>
@stop
