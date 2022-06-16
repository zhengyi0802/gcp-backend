<form name="project-new-form" action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" >
 @csrf
 <x-adminlte-modal id="newProject" title="{{ __('tables.new').__('projects.table_name') }}" theme="teal" size="lg"
   icon="fas fa-bell" v-centered static-backdrop scrollable>
   <div class="card-group">
     <x-adminlte-input name="name" label="{{ __('projects.name') }}" fgroup-class="col-md-6" />
     <x-adminlte-input name="company" label="{{ __('projects.company') }}" fgroup-class="col-md-6" />
   </div>
   <div class="card-group">
     <x-adminlte-input name="start_time" type="datetime" label="{{ __('projects.start_time') }}"
       placeHolder="YYYY-MM-DD hh-mm-ss" fgroup-class="col-md-6" />
     <x-adminlte-input name="stop_time" type="datetime" label="{{ __('projects.stop_time') }}"
       placeHolder="YYYY-MM-DD hh-mm-ss" fgroup-class="col-md-6" />
   </div>
   <div class="card-group">
     <x-adminlte-textarea name="description" label="{{ __('projects.description') }}" rows=5 fgroup-class="col-md-12"
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
<x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newProject" class="bg-teal" />
