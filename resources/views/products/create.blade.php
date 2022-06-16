    <form name="product-new-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newProduct" title="{{ __('tables.new').__('products.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
           <x-adminlte-select name="type_id" label="{{ __('products.type') }}" fgroup-class="col-md-6" >
             @foreach($producttypes as $type)
             <option value="{{ $type->id }}" >{{ $type->name }}</option>
             @endforeach
           </x-adminlte-select>
           <x-adminlte-select name="project_id" label="{{ __('products.project') }}" fgroup-class="col-md-6" >
             @foreach($projects as $project)
             <option value="{{ $project->id }}" >{{ $project->name }}</option>
             @endforeach
           </x-adminlte-select>
        </div>
        <div class="card-group col-md-12">
          <x-adminlte-input name="serialno" label="{{ __('products.serialno') }}" fgroup-class="col-md-4"
             />
          <x-adminlte-input name="ether_mac" label="{{ __('products.ether_mac') }}" fgroup-class="col-md-4"
             />
          <x-adminlte-input name="wifi_mac" label="{{ __('products.wifi_mac') }}" fgroup-class="col-md-4"
             />
        </div>
        <div class="card-group col-md-12">
          <x-adminlte-input name="expire_date" label="{{ __('products.expire_date') }}" fgroup-class="col-md-6"
             />
          <x-adminlte-select name="status_id" label="{{ __('products.status') }}" fgroup-class="col-md-6" >
            @foreach($productstatuses as $status)
            <option value="{{ $status->id }}" >{{ $status->name }}</option>
            @endforeach
          </x-adminlte-select>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-model>
    </form>
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newProduct" class="bg-teal" />
