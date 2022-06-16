@php
    $tconfig = [
        "title" => "可多選",
        "liveSearch" => true,
        "liveSearchPlaceholder" => "搜尋",
        "showTick" => true,
        "actionsBox" => true,
    ];
@endphp

<x-adminlte-select-bs id="types" name="type_id[]" label="{{ __('apkprograms.types') }}"
    label-class="text-danger" igroup-size="sm" :config="$tconfig" multiple fgroup-class="col-md-12">
    <x-slot name="prependSlot">
        <div class="input-group-text bg-gradient-red">
            <i class="fas fa-tag"></i>
        </div>
    </x-slot>
    <x-slot name="appendSlot">
        <x-adminlte-button theme="outline-dark" label="{{ __('options.clear') }}" icon="fas fa-lg fa-ban text-danger"/>
    </x-slot>
    @foreach($types as $type)
       <option value="{{ $type->id }}">{{ $type->name }}</option>
    @endforeach
</x-adminlte-select-bs>
