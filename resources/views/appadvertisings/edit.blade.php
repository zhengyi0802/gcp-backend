@extends('adminlte::page')

@section('title', __('appadvertisings.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('appadvertisings.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="appadvertising-edit-form" action="{{ route('appadvertisings.update', $appadvertising->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-select name="project_id" label="{{ __('appadvertisings.project') }}" fgroup-class="col-md-6" >
             @foreach($projects as $project)
             <option value="{{ $project->id }}" {{ ($appadvertising->project_id == $project->id) ? "selected" : null }} >
               {{ $project->name }}
             </option>
             @endforeach
        </x-adminlte-select>
        <x-adminlte-input name="interval" label="{{ __('adverrtisings.interval') }}" fgroup-class="col-md-6"
          value="{{ $appadvertising->interval }}" />
      </div>
    </div>
    <div class="row col-12">
        <div class="card-group col-md-12">
           <div class="card col-md-6">
           <img id="preview" theme="dark" width="320px" src="{{ $appadvertising->thumbnail }}" >
           <x-adminlte-input-file name="file" title="{{ __('appadvertisings.thumbnail') }}" onChange="loadImage(event)" />
           <script>
            var loadImage = function(event) {
                var output = document.getElementById('preview');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };
           </script>
           </div>
           <x-adminlte-input name="link_url"  label="{{ __('businesses.link_url') }}"
             fgroup-class="col-md-6" value="{{ $appadvertising->link_url }}" />
        </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
        @if (auth()->user()->canAudit(App\Enums\Content::AppMarketAdvertising))
        <x-adminlte-input-switch name="audit" label="{{ __('tables.audit') }}" fgroup-class="col-md-4" checked />
        @endif
      </div>
    </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ route('appadvertisings.index'); }}'" />
    </div>
    </form>
@stop
@section('plugins.BootstrapSwitch', true)
