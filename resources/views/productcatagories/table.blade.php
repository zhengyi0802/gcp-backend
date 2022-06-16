@php
$heads = [
    ['label' =>__('productcatagories.index'), 'width' => 10],
    __('productcatagories.name'),
    __('productcatagories.description'),
    __('productcatagories.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
<x-adminlte-datatable id="product-catagory-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
  @foreach($productcatagories as $productcatagory)
  <tr>
    <td>{!! $productcatagory->id !!}</td>
    <td>{!! $productcatagory->name !!}</td>
    <td>{!! $productcatagory->description !!}</td>
    <td>{!! $productcatagory->creator->name !!}</td>
    <td><nobr>
      <form name="productcatagory-delete-form" action="{{ route('productcatagories.destroy', $productcatagory->id); }}" method="POST">
        @csrf
        @method('DELETE')
        @if ($productcatagory->created_by != 1)
          <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
            onClick="window.location='{{ route('productcatagories.edit', $productcatagory->id); }}'" >
          </x-adminlte-button>
          <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
            type="submit" >
          </x-adminlte-button>
        @endif
        <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
           onClick="window.location='{{ route('productcatagories.show', $productcatagory->id); }}'" >
        </x-adminlte-button>
      </form>
    </nobr></td>
  </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
