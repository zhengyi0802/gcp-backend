<form name="customersupport-new-form" action="{{ route('customersupports.store') }}" method="POST" enctype="multipart/form-data" >
  @csrf
    <x-adminlte-modal id="newCustomersupport" title="{{ __('tables.new').__('customersupports.table_name') }}" theme="teal" size="lg"
      icon="fas fa-bell" v-centered static-backdrop scrollable>
      <div class="card-group">
        <x-adminlte-select name="project_id" label="{{ __('customersupports.project') }}" fgroup-class="col-md-6" >
          <option value="0" disabled >{{ __('projects.select_one') }}</option>
          @foreach($projects as $project)
          <option value="{{ $project->id }}" >
            {{ $project->name }}
          </option>
          @endforeach
        </x-adminlte-select>
        <x-adminlte-select name="qrcode_type" label="{{ __('customersupports.qrcode_type') }}"
          fgroup-class="col-md-6" onchange="changeInput(this)">
          <option value="image">{{ __('customersupports.type_image') }}</option>
          <option value="text">{{ __('customersupports.type_text') }}</option>
          <option value="none">{{ __('customersupports.type_none') }}</option>
        </x-adminlte-select>
        <script>
            var changeInput = function(select) {
                   if (select.value == 'image') {
                       document.getElementById('div-image').style.display="";
                       document.getElementById('div-text').style.display="none";
                   } else if (select.value == 'text') {
                       document.getElementById('div-image').style.display="none";
                       document.getElementById('div-text').style.display="";
                   } else {
                       document.getElementById('div-image').style.display="none";
                       document.getElementById('div-text').style.display="none";
                   }
               };
        </script>
      </div>
      <div class="card-group">
        <div id="div-image" class="card col-md-12">
          <img id="preview" width="320px" theme="dark" >
          <x-adminlte-input-file name="file" label="{{ __('customersupports.image') }}" onChange="loadImage(event)" />
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
      </div>
      <div class="card-group">
         <div id="div-text" class="card col-md-12" style="display:none">
           <x-adminlte-input name="qrcode_content"  label="{{ __('customersupports.qrcode_content') }}" />
         </div>
      </div>
      <div class="card-group">
         <x-adminlte-input name="message"  label="{{ __('customersupports.message') }}"
           fgroup-class="col-md-12" />
      </div>
      <div class="card-group">
        <x-adminlte-select name="apk_id" label="{{ __('customersupports.rcapp') }}" fgroup-class="col-md-12" >
          @foreach($apks as $apk)
          <option value="{{ $apk->id }}" >{{ $apk->label }}</option>
          @endforeach
        </x-adminlte-select>
      </div>
      <x-slot name="footerSlot">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"/>
      </x-slot>
    </x-adminlte-model>
</form>
<x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newCustomersupport" class="bg-teal" />
