@php
$heads = [
    ['label' =>__('menus.index'), 'width' => 10],
    __('menus.icon'),
    __('menus.name'),
    __('menus.project'),
    __('menus.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, ['orderable' => false], null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
      <x-adminlte-datatable id="menu-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($menus as $menu)
           <tr>
             <td>{!! $menu->id !!}</td>
             <td><img src="{!! $menu->icon !!}" width="64px" height="64px" ></td>
             <td>{!! $menu->name !!}</td>
             <td>{!! ($menu->project) ?$menu->project->name : null !!}</td>
             <td>{!! $menu->creator->name !!}</td>
             <td><nobr>
                    <form name="menu-delete-form" action="{{ route('menus.destroy', $menu->id); }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @if( $menu->created_by != 2)
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('menus.edit', $menu->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    @endif
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('menus.show', $menu->id); }}'" >
                    </x-adminlte-button>
                    </form>
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
