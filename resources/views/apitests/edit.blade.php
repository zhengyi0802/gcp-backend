@extends('adminlte::page')

@section('title', __('apitests.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('apitests.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="apitest-form" action="{{ route('apitests.update', $apitest->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-select name="project_id" label="{{ __('apitests.project') }}" fgroup-class="col-md-4" >
             <option value="0" disabled >{{ __('projects.select_one') }}</option>
             @foreach($projects as $project)
             <option value="{{ $project->id }}" {{ ($apitest->project_id == $project->id) ? "selected" : null }} >
               {{ $project->name }}
             </option>
             @endforeach
        </x-adminlte-select>
        <x-adminlte-select name="type" label="{{ __('apitests.type') }}" fgroup-class="col-md-4" >
             <option value="string" {{ ($apitest->type == 'string') ? "selected" : null  }} >{{ __('apitests.type_string') }}</option>
             <option value="jason" {{ ($apitest->type == 'jason') ? "selected" : null  }} >{{ __('apitests.type_jason') }}</option>
             <option value="plaintext" {{ ($apitest->type == 'plantext') ? "selected" : null  }} >{{ __('apitests.type_text') }}</option>
        </x-adminlte-select>
        <x-adminlte-input name="key" label="{{ __('apitests.key') }}" fgroup-class="col-md-4"
          value="{{ $apitest->key }}" />
      </div>
    </div>
    <div class="row col-12">
        <x-adminlte-textarea name="value" label="{{ __('apitests.value') }}" rows=5 fgroup-class="col-md-12"
           igroup-size="sm" >{{ $apitest->value }}
          <x-slot name="prependSlot">
            <div class="input-group-text bg-dark">
              <i class="fas fa-lg fa-file-alt text-warning"></i>
            </div>
          </x-slot>
       </x-adminlte-textarea>
    </div>
    <div class="row col-12">
        <x-adminlte-textarea name="memo" label="{{ __('apitests.memo') }}" rows=5 fgroup-class="col-md-12"
           igroup-size="sm" placeholder="Insert memo...">{{ $apitest->memo }}
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
          onClick="window.location='{{ route('apitests.index'); }}'" />
    </div>
    </form>
@stop
