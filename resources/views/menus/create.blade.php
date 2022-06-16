    <form name="menu-new-form" action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newMenu" title="{{ __('tables.new').__('menus.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
           <x-adminlte-input name="name" label="{{ __('menus.name') }}" fgroup-class="col-md-6" />
           <x-adminlte-select name="project_id" label="{{ __('menus.project') }}" fgroup-class="col-md-6" >
             <option value="0" disabled >{{ __('projects.select_one') }}</option>
             @foreach($projects as $project)
             <option value="{{ $project->id }}" >
               {{ $project->name }}
             </option>
             @endforeach
           </x-adminlte-select>
           <x-adminlte-select name="type" label="{{ __('menus.type') }}" fgroup-class="col-md-6" >
             <option value="video" selected >{{ __('menus.type_video') }}</option>
           </x-adminlte-select>
        </div>
        <div class="card-group">
           <div class="card col-md-6">
           <img id="preview" width="80px" height="80px" theme="dark" >
           <x-adminlte-input-file name="file" label="{{ __('menus.icon') }}" onChange="loadImage(event)" />
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
           <x-adminlte-input name="tag"  label="{{ __('menus.tag') }}"
             fgroup-class="col-md-6" />
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-model>
    </form>
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newMenu" class="bg-teal" />
