@extends('adminlte::page')

@section('title', __('marquees.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('marquees.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form name="marquee-new-form" action="{{ route('resellers.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
        <input name="p" value="marquee" type="hidden" >
        <input name="project_id" value="{{ $project_id }}" type="hidden" >
        <input name="type" value="2" type="hidden" >
        <div class="card-group">
           <x-adminlte-input name="name" label="{{ __('marquees.name') }}" fgroup-class="col-md-12" />
        </div>
        <div class="card-group">
           <x-adminlte-input name="content" label="{{ __('marquees.content') }}" fgroup-class="col-md-12" />
        </div>
        <div class="card-group">
           <x-adminlte-input name="url" label="{{ __('marquees.url') }}" fgroup-class="col-md-12" />
        </div>
        <div class="card-group">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}"
               onClick="window.location='{{ url()->previous(); }}'" />
        </div>
    </form>
@stop
