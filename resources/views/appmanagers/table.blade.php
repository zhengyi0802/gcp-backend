@php
$heads = [
    ['label' =>__('appmanagers.index'), 'width' => 10],
    __('appmanagers.project'),
    __('appmanagers.package'),
    __('appmanagers.icon'),
    __('appmanagers.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, ['orderable' => false], null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
      <x-adminlte-datatable id="appmanager-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($appmanagers as $appmanager)
           <tr>
             <td>{!! $appmanager->id !!}</td>
             <td>{!! $appmanager->project->name !!}</td>
             <td>{!! $appmanager->apk->label !!}</td>
             <td><img src="{!! $appmanager->apk->icon !!}" width="96px" ></td>
             <td>{!! $appmanager->creator->name !!}</td>
             <td><nobr>
                    <form name="appmanager-delete-form" action="{{ route('appmanagers.destroy', $appmanager->id); }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @if ($appmanager->created_by != 2)
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('appmanagers.edit', $appmanager->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    @endif
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('appmanagers.show', $appmanager->id); }}'" >
                    </x-adminlte-button>
                    </form>
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
