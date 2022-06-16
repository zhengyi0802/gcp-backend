'@extends('adminlte::page')

@section('title', __('hotapps.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('hotapps.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="hotapp-form" action="{{ route('hotapps.update', $hotapp->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-select name="project_id" label="{{ __('hotapps.project') }}" fgroup-class="col-md-4" >
             @foreach($projects as $project)
             <option value="{{ $project->id }}" {{ ($hotapp->project_id == $project->id) ? "selected" : null }} >
               {{ $project->name }}
             </option>
             @endforeach
        </x-adminlte-select>
        <x-adminlte-select name="catagory_id" label="{{ __('apkprograms.catagory') }}"
          fgroup-class="col-md-4" onchange="changeInput(this)" >
             @foreach($catagories as $catagory)
             <option value="{{ $catagory->id }}" {{ ($catagory_id == $catagory->id) ? "selected" : null }}>
               {{ $catagory->name }}
             </option>
             @endforeach
        </x-adminlte-select>
        <script>
            var changeInput = function(select) {
                window.location.href='/hotapps/{{ $hotapp->id }}/edit?catagory_id=' + select.value;
            };
        </script>
        <x-adminlte-select name="apk_id" label="{{ __('hotapps.package') }}" fgroup-class="col-md-4" >
             @foreach($apks as $apk)
             <option value="{{ $apk->id }}" {{ ($apk->id == $hotapp->apk->id) ? "selected" : null }}>{{ $apk->label }}</option>
             @endforeach
        </x-adminlte-select>
      </div>
    </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ route('hotapps.index'); }}'" />
    </div>
    </form>
@stop

