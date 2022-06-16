   <form name="voicesetting-new-form" action="{{ route('voicesettings.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newVoicesetting" title="{{ __('tables.new').__('voicesettings.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
           <x-adminlte-input name="keywords" label="{{ __('voicesettings.keywords') }}" fgroup-class="col-md-6" />
           <x-adminlte-select name="project_id" label="{{ __('voicesettings.project') }}" fgroup-class="col-md-6" >
             <option value="0" disabled >{{ __('projects.select_one') }}</option>
             @foreach($projects as $project)
             <option value="{{ $project->id }}" >
               {{ $project->name }}
             </option>
             @endforeach
           </x-adminlte-select>
         </div>
        <div class="card-group">
           <x-adminlte-select name="apk_id" label="{{ __('apkprograms.label') }}" fgroup-class="col-md-12" >
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
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newVoicesetting" class="bg-teal" />
