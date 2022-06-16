@extends('adminlte::page')

@section('title', __('mainvideos.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('mainvideos.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form name="mainvideo-new-form" action="{{ route('resellers.store') }}" method="POST" >
    @csrf
        <input name="p" value="mainvideo" type="hidden" >
        <input name="project_id" value="{{ $project_id }}" type="hidden" >
        <x-adminlte-select name="type" label="{{ __('mainvideos.type') }}" fgroup-class="col-md-6" >
          <option value="playlist" selected >{{ __('mainvideos.type_playlist') }}</option>
          <option value="youtube_playlist" >{{ __('mainvideos.type_youtube_playlist') }}</option>
          <option value="youtube_playlist_id" >{{ __('mainvideos.type_youtube_playlist_id') }}</option>
          <option value="stream" >{{ __('mainvideos.type_stream') }}</option>
        </x-adminlte-select>
        <div class="card-group">
           <x-adminlte-textarea name="playlist" label="{{ __('mainvideos.playlist') }}" rows=5 fgroup-class="col-md-12"
              igroup-size="sm" placeholder="Insert playlist...">
             <x-slot name="prependSlot">
               <div class="input-group-text bg-dark">
                 <i class="fas fa-lg fa-file-alt text-warning"></i>
               </div>
             </x-slot>
          </x-adminlte-textarea>
        </div>
        <div class="card-group">
           <x-adminlte-textarea name="description" label="{{ __('mainvideos.description') }}" rows=5 fgroup-class="col-md-12"
              igroup-size="sm" placeholder="Insert description...">
             <x-slot name="prependSlot">
               <div class="input-group-text bg-dark">
                 <i class="fas fa-lg fa-file-alt text-warning"></i>
               </div>
             </x-slot>
          </x-adminlte-textarea>
        </div>
        <div class="card-group">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}"
              onClick="window.location='{{ url()->previous(); }}'" />
        </div>
    </form>
@stop
