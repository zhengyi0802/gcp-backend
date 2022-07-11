    <form name="business-new-form" action="{{ route('businesses.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newBusiness" title="{{ __('tables.new').__('businesses.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
           <x-adminlte-select name="project_id" label="{{ __('businesses.project') }}" fgroup-class="col-md-4" >
             <option value="0" disabled >{{ __('projects.select_one') }}</option>
             @foreach($projects as $project)
             <option value="{{ $project->id }}" >
               {{ $project->name }}
             </option>
             @endforeach
           </x-adminlte-select>
           <x-adminlte-input name="serial"  label="{{ __('businesses.serial') }}"
             fgroup-class="col-md-4" value="1" />
           <x-adminlte-input name="intervals"  label="{{ __('businesses.intervals') }}"
             fgroup-class="col-md-4" value="15" />
        </div>
        <div class="card-group">
           <div class="card col-md-6">
           <img id="preview" width="320px" height="90px" theme="dark" >
           <x-adminlte-input-file name="file" label="{{ __('businesses.logo_url') }}" onChange="loadImage(event)" />
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
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-model>
    </form>
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newBusiness" class="bg-teal" />
