@php
$heads = [
    ['label' =>__('apkcatagories.index'), 'width' => 10],
    __('apkcatagories.name'),
    __('apkcatagories.parent'),
    __('apkcatagories.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
<x-adminlte-datatable id="apk-catagory-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
  @foreach($apkcatagories as $apkcatagory)
  <tr>
    <td>{!! $apkcatagory->id !!}</td>
    <td>{!! $apkcatagory->name !!}</td>
    <td>{!! ($apkcatagory->parent) ? $apkcatagory->parent->name : null !!}</td>
    <td>{!! $apkcatagory->creator->name !!}</td>
    <td><nobr>
      <form name="apkcatagory-delete-form" action="{{ route('apkcatagories.destroy', $apkcatagory->id); }}" method="POST">
        @csrf
        @method('DELETE')
        @if ($apkcatagory->created_by != 1)
          <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
            onClick="window.location='{{ route('apkcatagories.edit', $apkcatagory->id); }}'" >
          </x-adminlte-button>
          <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
            type="submit" >
          </x-adminlte-button>
        @endif
        <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
          onClick="window.location='{{ route('apkcatagories.show', $apkcatagory->id); }}'" >
        </x-adminlte-button>
      </form>
    </nobr></td>
  </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
