<form name="bulletinitem-new-form" action="{{ route('bulletinitems.store') }}" method="POST" enctype="multipart/form-data" >
  @csrf
  <x-adminlte-modal id="newBulletinitem" title="{{ __('tables.new').__('bulletinitems.table_name') }}" theme="teal" size="lg"
    icon="fas fa-bell" v-centered static-backdrop scrollable>
    <div class="card-group">
      <input type="hidden" name="bulletin_id" value="{{ $bulletin->id }}" >
      <x-adminlte-input type="text" name="bulletin" label="{{ __('bulletinitems.bulletin') }}" fgroup-class="col-md-12"
           value="{{ $bulletin->title.'('.$bulletin->date.')' }}" disabled />
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
      <x-adminlte-select name="mime_type" label="{{ __('bulletinitems.mime_type') }}" fgroup-class="col-md-6"
        onchange="changeInput(this)" >
        <option value="image" selected>{{ __('bulletinitems.type_image') }}</option>
        <option value="i_video" >{{ __('bulletinitems.type_video') }}</option>
        <option value="e_video" >{{ __('bulletinitems.type_external') }}</option>
        <option value="youtube" >{{ __('bulletinitems.type_youtube') }}</option>
      </x-adminlte-select>
      <x-adminlte-card title="{{ __('bulletinitems.url') }}" theme="teal" theme-mode="full" fgroup-class="col-md-6"
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
<x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newBulletinitem" class="bg-teal" />
