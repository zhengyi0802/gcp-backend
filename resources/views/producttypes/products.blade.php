@php
$heads = [
    ['label' =>__('products.index'), 'width' => 10],
    __('products.ether_mac'),
    __('products.wifi_mac'),
    __('products.project'),
    __('products.status'),
    __('products.expire_date'),
    __('products.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
<x-adminlte-datatable id="product-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
  @foreach($producttype->products as $product)
  <tr>
    <td>{!! $product->id !!}</td>
    <td>{!! $product->ether_mac !!}</td>
    <td>{!! $product->wifi_mac !!}</td>
    <td>{!! $product->project->name !!}</td>
    <td>{!! $product->status->name !!}</td>
    <td>{!! $product->expire_date !!}</td>
    <td>{!! $product->creator->name !!}</td>
    <td><nobr>
      <form name="product-delete-form" action="{{ route('products.destroy', $product->id); }}" method="POST">
        @csrf
        @method('DELETE')
        @if (auth()->user()->role <= App\Enums\UserRole::Operator)
        <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
          onClick="window.location='{{ route('products.edit', $product->id); }}'" >
        </x-adminlte-button>
        @endif
        @if (auth()->user()->role < App\Enums\UserRole::MainManager)
        <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
          type="submit" >
        </x-adminlte-button>
        @endif
        <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
          onClick="window.location='{{ route('products.show', $product->id); }}'" >
        </x-adminlte-button>
      </form>
    </nobr></td>
  </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

