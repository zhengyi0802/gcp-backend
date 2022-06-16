@extends('adminlte::page')

@section('title', __('appmenus.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('appmenus.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
<form action="{{ route('resellers.store') }}" method="POST" enctype="multipart/form-data" >
@csrf
    <div class="card col-md-6">
        <input name="project_id" value="{{ $project_id }}"
           fgroup-class="col-md-6" type="hidden" />
        <x-adminlte-input name="position" theme="primary" label="{{ __('appmenus.position') }}" value="{{ $position }}"
           fgroup-class="col-md-6" />
        <x-adminlte-select name="catagory_id" label="{{ __('apkprograms.catagory') }}"
           fgroup-class="col-md-6" onchange="changeInput(this)" >
           @foreach($catagories as $catagory)
           <option value="{{ $catagory->id }}" {{ ($catagory_id == $catagory->id) ? "selected" : null  }}>
             {{ (($catagory->parent_id > 0) ? '- ' : null) .$catagory->name }}
           </option>
           @endforeach
        </x-adminlte-select>
        <script>
           var changeInput = function(select) {
               window.location.href='/appmenus/create?project_id={{ $project_id }}&position={{ $position }}&catagory_id=' + select.value;
           };
        </script>
        <x-adminlte-select name="apk_id" label="{{ __('appmenus.label') }}" fgroup-class="col-md-6" >
           @foreach($apks as $apk)
             <option value="{{ $apk->id }}" >{{ $apk->label }}</option>
           @endforeach
        </x-adminlte-select>
    </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ url()->previous(); }}'" />
    </div>
</form>
@stop

