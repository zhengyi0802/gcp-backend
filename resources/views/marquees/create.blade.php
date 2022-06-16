    <form name="marquee-new-form" action="{{ route('marquees.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newMarquee" title="{{ __('tables.new').__('marquees.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
           <x-adminlte-select name="project_id" label="{{ __('marquees.project') }}" fgroup-class="col-md-6" >
             <option value="0" disabled >{{ __('projects.select_one') }}</option>
             @foreach($projects as $project)
             <option value="{{ $project->id }}" >
               {{ $project->name }}
             </option>
             @endforeach
           </x-adminlte-select>
           <x-adminlte-select name="type" label="{{ __('marquees.type') }}" fgroup-class="col-md-6" >
             <option value="1" disabled>{{ __('marquees.type_product') }}</option>
             <option value="2">{{ __('marquees.type_project') }}</option>
             <option value="3">{{ __('marquees.type_all') }}</option>
           </x-adminlte-select>
        </div>
        <div class="card-group">
           <x-adminlte-input name="name" label="{{ __('marquees.name') }}" fgroup-class="col-md-12" />
        </div>
        <div class="card-group">
           <x-adminlte-input name="content" label="{{ __('marquees.content') }}" fgroup-class="col-md-12" />
        </div>
        <div class="card-group">
           <x-adminlte-input name="url" label="{{ __('marquees.url') }}" fgroup-class="col-md-12" />
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-model>
    </form>
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newMarquee" class="bg-teal" />
