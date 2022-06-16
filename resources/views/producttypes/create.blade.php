<form name="producttype-new-form" action="{{ route('producttypes.store') }}" method="POST" enctype="multipart/form-data" >
  @csrf
    <div class="card-group">
      <x-adminlte-input name="name" label="{{ __('producttypes.name') }}" fgroup-class="col-md-6" />
      <x-adminlte-select name="catagory_id" label="{{ __('producttypes.catagory') }}" fgroup-class="col-md-6" >
        @foreach($productcatagories as $catagory)
        <option value="{{ $catagory->id }}" >
          {{ $catagory->name }}
        </option>
        @endforeach
      </x-adminlte-select>
    </div>
    <div class="card-group">
      <x-adminlte-textarea name="description" label="{{ __('producttypes.description') }}" rows=5 fgroup-class="col-md-12"
        igroup-size="sm" placeholder="Insert description...">
        <x-slot name="prependSlot">
          <div class="input-group-text bg-dark">
            <i class="fas fa-lg fa-file-alt text-warning"></i>
          </div>
        </x-slot>
      </x-adminlte-textarea>
    </div>
    <div class="card-group">
      <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
    </div>
</form>
