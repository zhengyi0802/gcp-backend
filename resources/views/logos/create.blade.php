    <form name="logo-new-form" action="{{ route('logos.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newLogo" title="{{ __('tables.new').__('logos.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
           <x-adminlte-input name="name" label="{{ __('logos.name') }}" fgroup-class="col-md-6" />
           <x-adminlte-select name="project_id" label="{{ __('logos.project') }}" fgroup-class="col-md-6" >
             <option value="0" disabled >{{ __('projects.select_one') }}</option>
             @foreach($projects as $project)
             <option value="{{ $project->id }}" >
               {{ $project->name }}
             </option>
             @endforeach
           </x-adminlte-select>
         </div>
        <div class="card-group">
           <div class="card col-md-6">
           <img id="preview" width="320px" height="90px" theme="dark" >
           <x-adminlte-input-file name="file" label="{{ __('logos.image') }}" onChange="loadImage(event)" />
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
           <x-adminlte-input name="link_url"  label="{{ __('logos.link_url') }}"
             fgroup-class="col-md-6" />
        </div>
        <div class="card-group">
           <x-adminlte-textarea name="description" label="{{ __('logos.description') }}" rows=5 fgroup-class="col-md-12"
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
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newLogo" class="bg-teal" />
