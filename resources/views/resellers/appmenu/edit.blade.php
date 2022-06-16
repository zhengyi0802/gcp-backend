@extends('adminlte::page')

@section('title', __('appmenus.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('appmenus.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
<form action="{{ route('resellers.update', $appmenu->id) }}" method="POST" enctype="multipart/form-data" >
@csrf
@method('PUT')
    <div class="card col-md-6">
        <input name="project_id" value="{{ $appmenu->project_id }}" hidden />
        <x-adminlte-input name="position" theme="primary" label="{{ __('appmenus.position') }}" value="{{ $appmenu->position }}" />
        <x-adminlte-select name="catagory_id" label="{{ __('apkmanagers.catagory') }}"
          fgroup-class="col-md-4" onchange="changeInput(this)" >
             @foreach($catagories as $catagory)
             <option value="{{ $catagory->id }}" {{ ($catagory_id == $catagory->id) ? "selected" : null }}>
               {{ $catagory->name }}
             </option>
             @endforeach
        </x-adminlte-select>
        <script>
            var changeInput = function(select) {
                window.location.href='/appmenus/{{ $appmenu->id }}/edit?catagory_id=' + select.value;
            };
        </script>
        <x-adminlte-select name="apk_id" label="{{ __('appmenus.label') }}" fgroup-class="col-md-4" >
             @foreach($apks as $apk)
             <option value="{{ $apk->id }}" {{ ($apk->id == $appmenu->apk->id) ? "selected" : null }}>{{ $apk->label }}</optio>
             @endforeach
        </x-adminlte-select>
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
    </div>
</form>
@stop
