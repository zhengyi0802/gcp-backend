    <form name="startpage-new-form" action="{{ route('startpages.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newstartpage" title="{{ __('tables.new').__('startpages.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
          <x-adminlte-select name="project_id" label="{{ __('startpages.project') }}" fgroup-class="col-md-6"
             onchange="changeProject(this)" >
             <option value="0" >{{ __('projects.select_one') }}</option>
             @foreach($projects as $project)
             <option value="{{ $project->id }}" >
               {{ $project->name }}
             </option>
             @endforeach
          </x-adminlte-select>
        </div>
        <script>
          function changeProject(event) {
              if (event.value == '0') {
                  document.getElementById('div-mp').style.display = '';
              } else {
                  document.getElementById('div-mp').style.display = 'none';
              }
          }
        </script>
        <div class="card-group">
           <x-adminlte-input name="name" label="{{ __('startpages.name') }}" fgroup-class="col-md-12" />
        </div>
        <div class="card-group">
            <script>
            var changeInput = function(select) {
                if (select.value == 'image') {
                    //alert(document.getElementById('url-input').style);
                    document.getElementById('url-input').style.display='none';
                    document.getElementById('upload-file').style.display='';
                    document.getElementById('preview-image').style.display='';
                } else if (select.value == "i_video") {
                    document.getElementById('url-input').style.display='none';
                    document.getElementById('upload-file').style.display='';
                    document.getElementById('preview-image').style.display='none';
                } else {
                    document.getElementById('url-input').style.display='';
                    document.getElementById('upload-file').style.display='none';
                    document.getElementById('preview-image').style.display='none';
                }
            };
            </script>
            <x-adminlte-select name="mime_type" label="{{ __('startpages.mime_type') }}" fgroup-class="col-md-6"
             onchange="changeInput(this)" >
             <option value="image" selected>{{ __('startpages.type_image') }}</option>
             <option value="i_video" >{{ __('startpages.type_video') }}</option>
             <option value="e_video" >{{ __('startpages.type_external') }}</option>
             <option value="youtube" >{{ __('startpages.type_youtube') }}</option>
           </x-adminlte-select>
           <x-adminlte-card title="{{ __('startpages.url') }}" theme="teal" theme-mode="full" fgroup-class="col-md-6"
              icon="fas fa-lg fa-photo">
              <div id="upload-file">
                <x-adminlte-input-file name="file" accept="image/* videos/mp4" onChange="loadImage(event)" />
              </div>
              <div id="url-input" style="display:none">
                <x-adminlte-input name="url" fgroup-class="col-md-12" />
              </div>
              <div class="col-md-6" id="preview-image" >
                <img name="preview" id="preview" width="180" >
              </div>
           </x-adminlte-card>
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
        <div class="card-group">
           <x-adminlte-input name="intervals" type="number" label="{{ __('startpages.intervals') }}"
             fgroup-class="col-md-4" value="15" />
           <x-adminlte-input name="start_time" type="datetime" label="{{ __('startpages.start_time') }}"
             placeHolder="YYYY-MM-DD hh-mm-ss" fgroup-class="col-md-4" />
           <x-adminlte-input name="stop_time" type="datetime" label="{{ __('startpages.stop_time') }}"
             placeHolder="YYYY-MM-DD hh-mm-ss" fgroup-class="col-md-4" />
        </div>
        <div class="card-group">
           <x-adminlte-textarea name="description" label="{{ __('startpages.description') }}" rows=5 fgroup-class="col-md-12"
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
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newstartpage" class="bg-teal" />
