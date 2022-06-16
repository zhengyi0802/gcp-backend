    <form name="bulletin-new-form" action="{{ route('bulletins.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newBulletin" title="{{ __('tables.new').__('bulletins.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
           <div class="card col-md-4">
             <label><h5>
               <input type="checkbox" name="popup" >
               <span>{{ __('bulletins.popup') }}</span>
             </h5></label>
           </div>
           <x-adminlte-select name="project_id" label="{{ __('bulletins.project') }}" fgroup-class="col-md-4" >
             <option value="0" disabled >{{ __('projects.select_one') }}</option>
             @foreach($projects as $project)
             <option value="{{ $project->id }}" >
               {{ $project->name }}
             </option>
             @endforeach
           </x-adminlte-select>
        </div>
        <div class="card-group">
           <x-adminlte-input name="title"  label="{{ __('bulletins.title') }}"
             fgroup-class="col-md-6" />
           <x-adminlte-input name="message"  label="{{ __('bulletins.message') }}"
             fgroup-class="col-md-6" />
           <x-adminlte-input name="date"  label="{{ __('bulletins.date') }}"
             fgroup-class="col-md-6" />
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-model>
    </form>
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newBulletin" class="bg-teal" />
