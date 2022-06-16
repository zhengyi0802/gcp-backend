@php
$heads = [
    ['label' =>__('customersupports.index'), 'width' => 10],
    __('customersupports.project'),
    __('customersupports.qrcode_type'),
    __('customersupports.message'),
    __('customersupports.rcapp_label'),
    __('customersupports.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
<x-adminlte-datatable id="customersupport-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
  @foreach($customersupports as $customersupport)
    <tr>
      <td>{!! $customersupport->id !!}</td>
      <td>{!! $customersupport->project->name !!}</td>
      <td>
        @if ($customersupport->qrcode_type == 'image')
          {{ __('customersupports.type_image') }}
        @elseif ($customersupport->qrcode_type == 'text')
          {{ __('customersupports.type_text') }}
        @elseif ($customersupport->qrcode_type == 'none')
          {{ __('customersupports.type_none') }}
        @endif
      </td>
      <td>{!! $customersupport->message !!}</td>
      <td>{!! $customersupport->apk->label !!}</td>
      <td>{!! $customersupport->creator->name !!}</td>
      <td><nobr>
        <form name="customersupport-delete-form" action="{{ route('customersupports.destroy', $customersupport->id); }}" method="POST">
          @csrf
          @method('DELETE')
          <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
            onClick="window.location='{{ route('customersupports.edit', $customersupport->id); }}'" >
          </x-adminlte-button>
          <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
            type="submit" >
          </x-adminlte-button>
          <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
            onClick="window.location='{{ route('customersupports.show', $customersupport->id); }}'" >
          </x-adminlte-button>
        </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
