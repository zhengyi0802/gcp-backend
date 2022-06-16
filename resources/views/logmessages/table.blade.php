@php
$heads = [
    ['label' =>__('logmessages.id'), 'width' => 10],
    __('logmessages.action'),
    __('logmessages.version_name'),
    __('logmessages.mac_eth'),
    __('logmessages.mac_wifi'),
    __('logmessages.created_at'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
<x-adminlte-datatable id="logmessage-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
  @foreach($logmessages as $logmessage)
  <tr class="form-group {{ ($logmessage->action == 'Error') ? 'bg-red' : null }}" >
    <td>{{ $logmessage->id }}</td>
    <td>{{ $logmessage->action }}</td>
    <td>{{ $logmessage->version_name }}</td>
    <td>{{ $logmessage->ether }}</td>
    <td>{{ $logmessage->wifi }}</td>
    <td>{{ $logmessage->created_at }}</td>
    <td><x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
          onClick="window.location='{{ route('logmessages.show', $logmessage->id); }}'" />
    </td>
  </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
