    <form name="advertising-new-form" action="{{ route('advertisings.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newAdvertising" title="{{ __('tables.new').__('advertisings.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
           <x-adminlte-select name="project_id" label="{{ __('advertisings.project') }}" fgroup-class="col-md-6" >
             <option value="0" disabled >{{ __('projects.select_one') }}</option>
             @foreach($projects as $project)
             <option value="{{ $project->id }}" >
               {{ $project->name }}
             </option>
             @endforeach
           </x-adminlte-select>
           <x-adminlte-input type="number" name="index"  label="{{ __('advertisings.index2') }}"
             fgroup-class="col-md-6" placeHolder="0" />
        </div>
        <div class="card-group">
           <div class="card col-md-6">
           <img id="preview" width="320px" theme="dark" >
           <x-adminlte-input-file name="file" label="{{ __('advertisings.thumbnail') }}" onChange="loadImage(event)" />
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
           <x-adminlte-input name="link_url"  label="{{ __('advertisings.link_url') }}"
             fgroup-class="col-md-6" />
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-model>
    </form>
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newAdvertising" class="bg-teal" />
