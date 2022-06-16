@php
$heads = [
    ['label' =>__('apitests.index'), 'width' => 10],
    __('apitests.project'),
    __('apitests.key'),
    __('apitests.type'),
    __('apitests.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
<x-adminlte-datatable id="apitest-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
  @foreach($apitests as $apitest)
  <tr>
    <td>{!! $apitest->id !!}</td>
    <td>{!! $apitest->project->name !!}</td>
    <td>{!! $apitest->key !!}</td>
    <td>@if ($apitest->type == 'string')
          {{ __('apitests.type_string') }}
        @elseif ($apitest->type == 'jason')
          {{ __('apitests.type_jason') }}
        @elseif ($apitest->type == 'plaintext')
          {{ __('apitests.type_plaintext') }}
        @endif
    </td>
    <td>{!! $apitest->creator->name !!}</td>
    <td><nobr>
      <form name="apitest-delete-form" action="{{ route('apitests.destroy', $apitest->id); }}" method="POST">
        @csrf
        @method('DELETE')
        @if ($apitest->created_by != 2)
          <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
            onClick="window.location='{{ route('apitests.edit', $apitest->id); }}'" >
          </x-adminlte-button>
          <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
            type="submit" >
          </x-adminlte-button>
        @endif
          <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
            onClick="window.location='{{ route('apitests.show', $apitest->id); }}'" >
          </x-adminlte-button>
      </form>
    </nobr></td>
  </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

