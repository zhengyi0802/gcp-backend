<form name="productcatagory-new-form" action="{{ route('productcatagories.store') }}" method="POST" enctype="multipart/form-data" >
  @csrf
    <div class="card-group">
      <x-adminlte-input name="name" label="{{ __('productcatagories.name') }}" fgroup-class="col-md-6" />
    </div>
    <div class="card-group">
      <x-adminlte-textarea name="description" label="{{ __('productcatagories.description') }}" rows=5 fgroup-class="col-md-12"
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

