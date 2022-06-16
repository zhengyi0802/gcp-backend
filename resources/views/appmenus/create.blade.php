@extends('adminlte::master')

@section('body')
<form action="{{ route('appmenus.store') }}" method="POST">
@csrf
    <div class="card col-md-6">
        <input name="project_id" value="{{ $project_id }}"
           fgroup-class="col-md-6" hidden />
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
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
    </div>
</form>
@stop

