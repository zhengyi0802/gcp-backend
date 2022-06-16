@extends('adminlte::master')

@section('popwindow')
    <form name="qalist-new-form" action="{{ route('qalists.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newQAList" title="{{ __('tables.new').__('qalists.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
           <x-adminlte-input name="catagory_id" value="{{ $catagory->id }}" hidden />
           <x-adminlte-input name="catagory" label="{{ __('qalists.catagory') }}" value="{{ $catagory->name }}" />
           <x-adminlte-input name="question" label="{{ __('qalists.question') }}" fgroup-class="col-md-6" />
           <x-adminlte-select name="type" label="{{ __('qalists.type') }}" fgroup-class="col-md-6"
             onchange="changeInput(this)" >
             <option value="image" selected>{{ __('startpages.type_image') }}</option>
             <option value="i_video" >{{ __('startpages.type_video') }}</option>
             <option value="e_video" >{{ __('startpages.type_external') }}</option>
             <option value="youtube" >{{ __('startpages.type_youtube') }}</option>
           </x-adminlte-select>
         </div>
         <div class="card-group">
           <script>
           var changeInput = function(select) {
                if (select.value == 'image') {
                    //alert(document.getElementById('url-input').style);
                    document.getElementById('url-input').style.display='none';
                    document.getElementById('upload-file').style.display='';
                    document.getElementById('preview-image').style.display='';
                } else if (select.value == "i_video") {
                    document.getElementById('url-input').style.display='none';
                    document.getElementById('upload-file').style.display='';
                    document.getElementById('preview-image').style.display='none';
                } else {
                    document.getElementById('url-input').style.display='';
                    document.getElementById('upload-file').style.display='none';
                    document.getElementById('preview-image').style.display='none';
                }
           };
           </script>
           <x-adminlte-card title="{{ __('qalists.answer') }}" theme="teal" theme-mode="full" fgroup-class="col-md-6"
              icon="fas fa-lg fa-photo">
              <div id="upload-file">
                <x-adminlte-input-file name="file" accept="image/* videos/mp4" onChange="loadImage(event)" />
              </div>
              <div id="url-input" style="display:none">
                <x-adminlte-input name="url" fgroup-class="col-md-12" />
              </div>
              <div class="col-md-6" id="preview-image" >
                <img name="preview" id="preview" width="180" >
              </div>
           </x-adminlte-card>
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
         <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"/>
         </x-slot>
    </x-adminlte-model>
    </form>
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newQAList" class="bg-teal" />
@stop

@section('body')

@yield('popwindow')

<div class="row col-md-6">
    @foreach($qalists as $qalist)
        <table cols="2" rows="1" width="100%">
           <div class="card-group">
           <tr class="bg-info"><h2>
              <td width="80%">{{ $qalist->question }}</td>
              <td width="20%"><nobr>
                <form name="qalist-delete-form" action="{{ route('qalists.destroy', $qalist->id); }}" method="POST">
                @csrf
                @method('DELETE')
                <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                    onClick="window.location='{{ route('qalists.edit', $qalist->id); }}'" >
                </x-adminlte-button>
                <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                    type="submit" >
                </x-adminlte-button>
                </form></nobr>
              </td>
           </h2></tr>
           </div>
        </table>
    @endforeach
</div>
@stop
