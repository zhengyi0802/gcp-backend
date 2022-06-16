    <form name="hotapp-new-form" action="{{ route('hotapps.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newHotapp" title="{{ __('tables.new').__('hotapps.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
           <x-adminlte-select name="project_id" label="{{ __('hotapps.project') }}" fgroup-class="col-md-6" >
             @foreach($projects as $project)
             <option value="{{ $project->id }}" >
               {{ $project->name }}
             </option>
             @endforeach
           </x-adminlte-select>
           <x-adminlte-select name="catagory_id" label="{{ __('apkprograms.catagory') }}" 
             fgroup-class="col-md-6" onchange="changeInput(this)" >
             @foreach($catagories as $catagory)
             <option value="{{ $catagory->id }}" >{{ (($catagory->parent_id > 0) ? '- ' : null) .$catagory->name }}</option>
             @endforeach
           </x-adminlte-select>
           <script>
             var changeInput = function(select) {
                 window.location.href='/hotapps?catagory_id=' + select.value;
             };
           </script>
        </div>
        <div class="card-group">
           <x-adminlte-select name="apk_id" label="{{ __('hotapps.package') }}" fgroup-class="col-md-4" >
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
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newHotapp" class="bg-teal" />
