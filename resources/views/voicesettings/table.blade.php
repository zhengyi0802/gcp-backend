@php
$heads = [
    ['label' =>__('voicesettings.index'), 'width' => 10],
    __('voicesettings.project'),
    __('voicesettings.keywords'),
    __('voicesettings.label'),
    __('voicesettings.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
      <x-adminlte-datatable id="table3" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($voicesettings as $voicesetting)
           <tr>
             <td>{!! $voicesetting->id !!}</td>
             <td>{!! $voicesetting->project->name !!}</td>
             <td>{!! $voicesetting->keywords !!}</td>
             <td>{!! $voicesetting->label !!}</td>
             <td>{!! $voicesetting->creator->name !!}</td>
             <td><nobr>
                    <form name="voicesetting-delete-form" action="{{ route('voicesettings.destroy', $voicesetting->id); }}" method="POST>
                    @csrf
                    @method('DELETE')
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('voicesettings.edit', $voicesetting->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('voicesettings.show', $voicesetting->id); }}'" >
                    </x-adminlte-button>
                    </form>
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
