@php
$heads = [
    ['label' =>__('bulletins.index'), 'width' => 10],
    __('bulletins.project'),
    __('bulletins.title'),
    __('bulletins.date'),
    __('bulletins.popup'),
    __('bulletins.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
<x-adminlte-datatable id="bulletin-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
    @foreach($bulletins as $bulletin)
    <tr>
        <td>{!! $bulletin->id !!}</td>
        <td>{!! $bulletin->project->name !!}</td>
        <td>{!! $bulletin->title !!}</td>
        <td>{!! $bulletin->date !!}</td>
        <td>{!! $bulletin->popup ? __('bulletins.popup_yes') : __('bulletins.popup_no') !!}</td>
        <td>{!! $bulletin->creator->name !!}</td>
        <td><nobr>
            <form name="bulletin-delete-form" action="{{ route('bulletins.destroy', $bulletin->id); }}" method="POST>
              @csrf
              @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('bulletins.edit', $bulletin->id); }}'" >
              </x-adminlte-button>
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" >
              </x-adminlte-button>
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('bulletins.show', $bulletin->id); }}'" >
              </x-adminlte-button>
             </form>
        </nobr></td>
    </tr>
    @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
