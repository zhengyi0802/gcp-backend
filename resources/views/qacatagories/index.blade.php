@extends('adminlte::page')

@section('title', __('qacatagories.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('qacatagories.page_header') }}</h1>
@stop

@section('messages')
      @if ($message = Session::get('insert-success'))
      <x-adminlte-card title="{{ __('qacatagories.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('qacatagories.insert_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('insert-error'))
      <x-adminlte-card title="{{ __('qacatagories.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('qacatagories.insert_error') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-success'))
      <x-adminlte-card title="{{ __('qacatagories.success_message') }}" theme="info" icon="fas fa-lg fa-bell" removable>
         {{ __('qacatagories.update_ok') }}
      </x-adminlte-card>
      @endif
      @if ($message = Session::get('update-error'))
      <x-adminlte-card title="{{ __('qacatagories.error_message') }}" theme="danger" icon="fas fa-lg fa-bell" removable>
         {{ __('qacatagories.update_error') }}
      </x-adminlte-card>
      @endif
@stop

@section('popwindow')
    <form name="qacatagory-new-form" action="{{ route('qacatagories.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newQACatagory" title="{{ __('tables.new').__('qacatagories.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
           <x-adminlte-select name="position" label="{{ __('qacatagories.position') }}" fgroup-class="col-md-6" >
             @for($i = 1; $i <= 10; $i++)
             <option value="{{ $i }}" >{{ $i }}</option>
             @endfor
           </x-adminlte-select>
           <x-adminlte-input name="name" label="{{ __('qacatagories.name') }}" fgroup-class="col-md-6" />
         </div>
        <div class="card-group">
           <x-adminlte-textarea name="description" label="{{ __('qacatagories.description') }}" rows=5 fgroup-class="col-md-12"
              igroup-size="sm" placeholder="Insert description...">
             <x-slot name="prependSlot">
               <div class="input-group-text bg-dark">
                 <i class="fas fa-lg fa-file-alt text-warning"></i>
               </div>
             </x-slot>
          </x-adminlte-textarea>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-model>
    </form>
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newQACatagory" class="bg-teal" />
@stop

@section('content')

    @yield('popwindow')

    <div class="row col-12">
      @yield('messages')
    </div>

    <div class="row col-12">
      <div class="card-group col-md-12">
         <div class="card col-md-6">
             @foreach($qacatagories as $qacatagory)
                 @include('qacatagories.table')
             @endforeach
             <script>
                function subFrame(i) {
                   var listform = document.getElementById('qalists');
                   listform.src = "qalists?catagory_id=" + i;
                }
             </script>
         </div>
         <div class="card col-md-6">
             <iframe id="qalists" height="640px"></iframe>
         </div>
      </div>
    </div>
    {!! $qacatagories->links(); !!}
@stop
