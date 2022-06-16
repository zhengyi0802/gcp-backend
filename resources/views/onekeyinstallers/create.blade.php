@extends('adminlte::page')

@section('title', __('onekeyinstallers.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('onekeyinstallers.page_header') }}</h1>
@stop

@section('content')
   <form name="onekeyinstaller-new-form" action="{{ route('onekeyinstallers.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
        <div class="card-group">
           <x-adminlte-select name="project_id" label="{{ __('onekeyinstallers.project') }}" fgroup-class="col-md-6" >
             @foreach($projects as $project)
             <option value="{{ $project->id }}" >
               {{ $project->name }}
             </option>
             @endforeach
           </x-adminlte-select>
           <x-adminlte-select name="catagory_id" label="{{ __('apkprograms.catagory') }}"
             fgroup-class="col-md-6" onchange="changeInput(this)" >
             @foreach($catagories as $catagory)
             <option value="{{ $catagory->id }}" {{ ($catagory->id == $catagory_id) ? "selected" : null }} >
               {{ (($catagory->parent_id > 0) ? '- ' : null) .$catagory->name }}
             </option>
             @endforeach
           </x-adminlte-select>
           <script>
             var changeInput = function(select) {
                 window.location.href='/onekeyinstallers/create?catagory_id=' + select.value;
             };
           </script>
        </div>
        <div class="card-group">
            <x-adminlte-select name="apk_id" label="{{ __('onekeyinstallers.package') }}" fgroup-class="col-md-6" >
             @foreach($apks as $apk)
             <option value="{{ $apk->id }}" >{{ $apk->label }}</option>
             @endforeach
           </x-adminlte-select>
        </div>
        <div class="card-group">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
              onClick="window.location='{{ route('onekeyinstallers.index'); }}'" />
        </div>
    </form>
@stop
