    <form name="mainvideo-new-form" action="{{ route('mainvideos.store') }}" method="POST" >
    @csrf
    <x-adminlte-modal id="newMainVideo" title="{{ __('tables.new').__('mainvideos.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
          <x-adminlte-select name="project_id" label="{{ __('mainvideos.project') }}" fgroup-class="col-md-6" 
            onchange="changeProject(this)">
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
        <x-adminlte-select name="type" label="{{ __('mainvideos.type') }}" fgroup-class="col-md-6" >
          <option value="playlist" selected >{{ __('mainvideos.type_playlist') }}</option>
          <option value="youtube_playlist" >{{ __('mainvideos.type_youtube_playlist') }}</option>
          <option value="youtube_playlist_id" >{{ __('mainvideos.type_youtube_playlist_id') }}</option>
          <option value="stream" >{{ __('mainvideos.type_stream') }}</option>
        </x-adminlte-select>
        <div class="card-group">
           <x-adminlte-textarea name="playlist" label="{{ __('mainvideos.playlist') }}" rows=5 fgroup-class="col-md-12"
              igroup-size="sm" placeholder="Insert playlist...">
             <x-slot name="prependSlot">
               <div class="input-group-text bg-dark">
                 <i class="fas fa-lg fa-file-alt text-warning"></i>
               </div>
             </x-slot>
          </x-adminlte-textarea>
        </div>
        <div class="card-group">
           <x-adminlte-textarea name="description" label="{{ __('mainvideos.description') }}" rows=5 fgroup-class="col-md-12"
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
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newMainVideo" class="bg-teal" />
