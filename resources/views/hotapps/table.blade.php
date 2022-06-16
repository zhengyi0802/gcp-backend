@php
$heads = [
    ['label' =>__('hotapps.index'), 'width' => 10],
    __('hotapps.project'),
    __('hotapps.package'),
    __('hotapps.icon'),
    __('hotapps.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, ['orderable' => false], null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
      <x-adminlte-datatable id="hotapp-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($hotapps as $hotapp)
           <tr>
             <td>{!! $hotapp->id !!}</td>
             <td>{!! $hotapp->project->name !!}</td>
             <td>{!! $hotapp->apk->label !!}</td>
             <td><img src="{!! $hotapp->apk->icon !!}" width="128px"></td>
             <td>{!! $hotapp->creator->name !!}</td>
             <td><nobr>
                    <form name="hotapp-delete-form" action="{{ route('hotapps.destroy', $hotapp->id); }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @if ($hotapp->created_by != 2)
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('hotapps.edit', $hotapp->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    @endif
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('hotapps.show', $hotapp->id); }}'" >
                    </x-adminlte-button>
                    </form>
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
