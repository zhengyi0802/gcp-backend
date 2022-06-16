@extends('adminlte::page')

@section('title', __('apkcatagories.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('apkcatagories.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="apkcatagory-form" action="{{ route('apkcatagories.update', $apkcatagory->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="name" label="{{ __('apkcatagories.name') }}" fgroup-class="col-md-6"
          value="{{ $apkcatagory->name }}" />
        <x-adminlte-select name="parent_id" label="{{ __('apkcatagories.parent') }}" fgroup-class="col-md-4" >
             @foreach($parents as $parent)
             <option value="{{ $parent->id }}" {{ ($apkcatagory->parent_id == $parent->id) ? "selected" : null }} >
               {{ (($parent->parent_id > 0) ? '-' : null).$parent->name }}
             </option>
             @endforeach
        </x-adminlte-select>
      </div>
    </div>
    <div class="row col-12">
        <x-adminlte-textarea name="description" label="{{ __('apkcatagories.description') }}" rows=5 fgroup-class="col-md-12"
           igroup-size="sm" placeholder="Insert description...">{{ $apkcatagory->description }}
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
          onClick="window.location='{{ route('apkcatagories.index'); }}'" />
    </div>
    </form>
@stop

