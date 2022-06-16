<form name="apitest-new-form" action="{{ route('apitests.store') }}" method="POST" enctype="multipart/form-data" >
  @csrf
  <x-adminlte-modal id="newApitest" title="{{ __('tables.new').__('apitests.table_name') }}" theme="teal" size="lg"
    icon="fas fa-bell" v-centered static-backdrop scrollable>
     <div class="card-group">
       <x-adminlte-select name="project_id" label="{{ __('apitests.project') }}" fgroup-class="col-md-4" >
         <option value="0" disabled>{{ __('projects.select_one') }}</option>
         @foreach($projects as $project)
           <option value="{{ $project->id }}" >{{ $project->name }}</option>
         @endforeach
       </x-adminlte-select>
       <x-adminlte-select name="type" label="{{ __('apitests.type') }}" fgroup-class="col-md-4" >
         <option value="string">{{ __('apitests.type_string') }}</option>
         <option value="jason">{{ __('apitests.type_jason') }}</option>
         <option value="plaintext">{{ __('apitests.type_text') }}</option>
       </x-adminlte-select>
       <x-adminlte-input name="key" label="{{ __('apitests.key') }}" fgroup-class="col-md-4" />
     </div>
     <div class="card-group">
       <x-adminlte-textarea name="value" label="{{ __('apitests.value') }}" rows=5 fgroup-class="col-md-12"
         igroup-size="sm" placeholder="Insert value...">
         <x-slot name="prependSlot">
           <div class="input-group-text bg-dark">
             <i class="fas fa-lg fa-file-alt text-warning"></i>
           </div>
         </x-slot>
       </x-adminlte-textarea>
     </div>
      <div class="card-group">
        <x-adminlte-textarea name="memo" label="{{ __('apitests.memo') }}" rows=5 fgroup-class="col-md-12"
          igroup-size="sm" placeholder="Insert memo...">
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
<x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newApitest" class="bg-teal" />
