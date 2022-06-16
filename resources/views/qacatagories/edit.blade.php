@extends('adminlte::page')

@section('title', __('qacatagories.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('qacatagories.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="qacatagory-form" action="{{ route('qacatagories.update', $qacatagory->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="position" label="{{ __('qacatagories.position') }}" fgroup-class="col-md-4"
          value="{{ $qacatagory->position }}" disabled />
        <x-adminlte-input name="name" label="{{ __('qacatagories.name') }}" fgroup-class="col-md-4"
          value="{{ $qacatagory->name }}" />
        @if (auth()->user()->canAudit(App\Enums\Content::QA))
        <x-adminlte-input-switch name="audit" label="{{ __('tables.audit') }}" fgroup-class="col-md-4" checked />
        @endif
      </div>
    </div>
    <div class="row col-12">
        <x-adminlte-textarea name="description" label="{{ __('qacatagories.description') }}" rows=5 fgroup-class="col-md-12"
           igroup-size="sm" placeholder="Insert description...">{{ $qacatagory->description }}
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
          onClick="window.location='{{ route('qacatagories.index'); }}'" />
    </div>
    </form>
@stop
@section('plugins.BootstrapSwitch', true)
