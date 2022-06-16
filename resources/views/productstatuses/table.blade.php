@php
$heads = [
    ['label' =>__('productstatuses.index'), 'width' => 10],
    __('productstatuses.name'),
    __('productstatuses.description'),
    __('productstatuses.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
<x-adminlte-datatable id="table3" :heads="$heads" :config="$config" theme="info" striped hoverable>
  @foreach($productstatuses as $productstatus)
  <tr>
    <td>{!! $productstatus->id !!}</td>
    <td>{!! $productstatus->name !!}</td>
    <td>{!! $productstatus->description !!}</td>
    <td>{!! $productstatus->creator->name !!}</td>
    <td><nobr>
      <form name="productstatus-delete-form" action="{{ route('productstatuses.destroy', $productstatus->id); }}" method="POST">
        @csrf
        @method('DELETE')
        @if ($productstatus->created_by != 1)
          <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
            onClick="window.location='{{ route('productstatuses.edit', $productstatus->id); }}'" >
          </x-adminlte-button>
          <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
            type="submit" >
          </x-adminlte-button>
        @endif
        <x-adminlte-button theme="info" title="{{ __('tables.description') }}" icon="fa fa-lg fa-fw fa-eye"
          onClick="window.location='{{ route('productstatuses.show', $productstatus->id); }}'" >
        </x-adminlte-button>
      </form>
    </nobr></td>
  </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
