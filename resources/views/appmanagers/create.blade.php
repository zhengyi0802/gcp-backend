@php
$sconfig = [
    'onColor' => 'orange',
    'offColor' => 'dark',
    'inverse' => true,
    'animate' => false,
    'state' => true,
    'labelText' => '<i class="fas fa-2x fa-fw fa-lightbulb text-orange"></i>',
];
@endphp
    <form name="appmanager-new-form" action="{{ route('appmanagers.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newappmanager" title="{{ __('tables.new').__('appmanagers.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
           <x-adminlte-select name="project_id" label="{{ __('appmanagers.project') }}" fgroup-class="col-md-6" >
             @foreach($projects as $project)
             <option value="{{ $project->id }}" >
               {{ $project->name }}
             </option>
             @endforeach
           </x-adminlte-select>
           <x-adminlte-select name="apk_id" label="{{ __('appmanagers.package') }}" fgroup-class="col-md-4" >
             @foreach($apks as $apk)
             <option value="{{ $apk->id }}" >{{ $apk->label }}</option>
             @endforeach
           </x-adminlte-select>
        </div>
        <div class="card-group">
           <x-adminlte-input name="delaytime" type="number" label="{{ __('appmanagers.delaytime') }}" 
             placeHolder="5" fgroup-class="col-md-4" />
           <x-adminlte-input-switch name="market_id" label="{{ __('appmanagers.market') }}"
              data-on-text="{{ __('status.enabled') }}" data-off-text="{{ __('status.disabled') }}"
              data-on-color="teal" config="sconfig" fgroup-class="col-md-4" />
           <x-adminlte-input-switch name="installer_flag" label="{{ __('appmanagers.installer') }}"
              data-on-text="{{ __('status.enabled') }}" data-off-text="{{ __('status.disabled') }}"
              data-on-color="teal" config="sconfig" fgroup-class="col-md-4" />
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-model>
    </form>
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newappmanager" class="bg-teal" />
