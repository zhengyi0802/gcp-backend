<form name="apkcatagory-new-form" action="{{ route('apkcatagories.store') }}" method="POST" >
  @csrf
    <div class="card-group">
      <x-adminlte-input name="name" label="{{ __('apkcatagories.name') }}" fgroup-class="col-md-6" />
      <x-adminlte-select name="parent_id" label="{{ __('apkcatagories.parent') }}" fgroup-class="col-md-4" >
        <option value="0" selected>{{ __('apkcatagories.root') }}</option>
        @foreach($apkcatagories as $parent)
          <option value="{{ $parent->id }}" >{{ (($parent->parent_id > 0) ? '-' : null). $parent->name }}</option>
        @endforeach
      </x-adminlte-select>
    </div>
    <div class="card-group">
      <x-adminlte-textarea name="description" label="{{ __('apkcatagories.description') }}" rows=5 fgroup-class="col-md-12"
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
