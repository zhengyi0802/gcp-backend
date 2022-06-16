@php
$heads = [
    ['label' =>__('producttypes.index'), 'width' => 10],
    __('producttypes.catagory'),
    __('producttypes.name'),
    __('producttypes.description'),
    __('producttypes.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
<x-adminlte-datatable id="product-type-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
  @foreach($producttypes as $producttype)
    <tr>
      <td>{!! $producttype->id !!}</td>
      <td>{!! $producttype->catagory->name !!}</td>
      <td>{!! $producttype->name !!}</td>
      <td>{!! $producttype->description !!}</td>
      <td>{!! $producttype->creator->name !!}</td>
       <td><nobr>
         <form name="producttype-delete-form" action="{{ route('producttypes.destroy', $producttype->id); }}" method="POST">
           @csrf
           @method('DELETE')
           @if ($producttype->created_by != 1)
             <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
               onClick="window.location='{{ route('producttypes.edit', $producttype->id); }}'" >
             </x-adminlte-button>
             <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
               type="submit" >
             </x-adminlte-button>
           @endif
           <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
             onClick="window.location='{{ route('producttypes.show', $producttype->id); }}'" >
           </x-adminlte-button>
         </form>
       </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
