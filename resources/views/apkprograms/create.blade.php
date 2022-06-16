    <form name="apkprogram-new-form" action="{{ route('apkprograms.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newapkprogram" title="{{ __('tables.new').__('apkprograms.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group col-md-12">
           @include('apkprograms.listprojects')
        </div>
        <div class="card-group col-md-12">
           @include('apkprograms.listtypes')
        </div>
        <div class="card-group col-md-12">
           <x-adminlte-select id="catagory_id" name="catagory_id" label="{{ __('apkprograms.catagory') }}"
             fgroup-class="col-md-12" >
             @foreach($catagories as $catagory)
             <option value="{{ $catagory->id }}" >{{ $catagory->name }}</option>
             @endforeach
           </x-adminlte-select>
        </div>
        <div class="card-group col-md-12">
           <x-adminlte-select id="launcher_id" name="launcher_id" label="{{ __('apkprograms.launcher_id') }}"
             fgroup-class="col-md-4" onchange="changeInput(this)" >
             <option value="0">{{ __('apkprograms.launcher_nil') }}</option>
             <option value="1">{{ __('apkprograms.launcher_magicviewer') }}</option>
             <option value="2">{{ __('apkprograms.launcher_joylife') }}</option>
           </x-adminlte-select>
           <x-adminlte-select id="from" name="from" label="{{ __('apkprograms.from') }}"
             fgroup-class="col-md-4" onchange="changeInput(this)" >
             <option value="upload">{{ __('apkprograms.from_upload') }}</option>
             <option value="external">{{ __('apkprograms.from_external') }}</option>
           </x-adminlte-select>
           <div class="card col-md-6" id="div-upload">
           <x-adminlte-input-file name="file" label="{{ __('apkprograms.upload') }}" />
           </div>
           <div class="card col-md-6" id="div-external" style="display:none">
           <x-adminlte-input name="label"  label="{{ __('apkprograms.label') }}" />
           </div>
           <script>
             var changeInput = function(select) {
                 if (select.value == "upload") {
                     document.getElementById('div-upload').style.display='';
                     document.getElementById('div-external').style.display='none';
                     document.getElementById('div-external2').style.display='none';
                 } else {
                     document.getElementById('div-upload').style.display='none';
                     document.getElementById('div-external').style.display='';
                     document.getElementById('div-external2').style.display='';
                 }
             };
           </script>
        </div>
        <div id="div-external2" class="card-group" style="display:none" >
           <x-adminlte-input name="name"  label="{{ __('apkprograms.name') }}" fgroup-class="col-md-6" />
           <x-adminlte-input-file name="file2" label="{{ __('apkprograms.icon') }}" fgroup-class="col-md-6" />
           <x-adminlte-input name="path"  label="{{ __('apkprograms.url') }}" fgroup-class="col-md-12" />
        </div>
        <div class="card-group">
           <x-adminlte-textarea name="mac_addresses" label="{{ __('apkprograms.macaddresses') }}" rows=5 fgroup-class="col-md-12"
              igroup-size="sm" placeholder="Insert macaddresses...">
             <x-slot name="prependSlot">
               <div class="input-group-text bg-dark">
                 <i class="fas fa-lg fa-file-alt text-warning"></i>
               </div>
             </x-slot>
          </x-adminlte-textarea>
        </div>
        <div class="card-group">
           <x-adminlte-textarea name="description" label="{{ __('apkprograms.description') }}" rows=5 fgroup-class="col-md-12"
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
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newapkprogram" class="bg-teal" />
