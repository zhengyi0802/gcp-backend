@php
$heads = [
    ['label' =>__('marquees.index'), 'width' => 10],
    __('marquees.type'),
    __('marquees.project'),
    __('marquees.content'),
    __('marquees.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
<x-adminlte-datatable id="marquee-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
  @foreach($marquees as $marquee)
  <tr>
    <td>{!! $marquee->id !!}</td>
    <td>
       @if ($marquee->type == '1')
           {{ __('marquees.type_product') }}
       @elseif ($marquee->type == '2')
           {{ __('marquees.type_project') }}
       @elseif ($marquee->type == '3')
           {{ __('marquees.type_all') }}
       @endif
    </td>
    <td>{!! ($marquee->project) ?$marquee->project->name : null !!}</td>
    <td>{!! $marquee->content !!}</td>
    <td>{!! $marquee->creator->name !!}</td>
    <td><nobr>
      <form name="marquee-delete-form" action="{{ route('marquees.destroy', $marquee->id); }}" method="POST">
        @csrf
        @method('DELETE')
        <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
          onClick="window.location='{{ route('marquees.edit', $marquee->id); }}'" >
        </x-adminlte-button>
        <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
          type="submit" >
        </x-adminlte-button>
        <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
          onClick="window.location='{{ route('marquees.show', $marquee->id); }}'" >
        </x-adminlte-button>
       </form>
    </nobr></td>
  </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

