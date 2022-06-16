@php
$heads = [
    ['label' =>__('onekeyinstallers.index'), 'width' => 10],
    __('onekeyinstallers.project'),
    __('onekeyinstallers.package'),
    __('onekeyinstallers.icon'),
    __('onekeyinstallers.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, ['orderable' => false], null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
      <x-adminlte-datatable id="onekeyinstaller-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($onekeyinstallers as $onekeyinstaller)
           <tr>
             <td>{!! $onekeyinstaller->id !!}</td>
             <td>{!! $onekeyinstaller->project->name !!}</td>
             <td>{!! $onekeyinstaller->apk->label !!}</td>
             <td><img src="{!! $onekeyinstaller->apk->icon !!}" width="128px"></td>
             <td>{!! $onekeyinstaller->creator->name !!}</td>
             <td><nobr>
                    <form name="onekeyinstaller-delete-form" action="{{ route('onekeyinstallers.destroy', $onekeyinstaller->id); }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @if ($onekeyinstaller->created_by != 2)
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('onekeyinstallers.edit', $onekeyinstaller->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    @endif
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('onekeyinstallers.show', $onekeyinstaller->id); }}'" >
                    </x-adminlte-button>
                    </form>
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
