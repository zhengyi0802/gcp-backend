@php
$heads = [
    ['label' =>__('appadvertisings.index'), 'width' => 10],
    __('appadvertisings.project'),
    __('appadvertisings.created_by'),
    __('appadvertisings.thumbnail'),
    __('appadvertisings.interval'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, ['orderable' => false], ['orderable' => false], ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
    <div class="row col-12">
      <x-adminlte-datatable id="appadvertising-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($appadvertisings as $appadvertising)
           <tr>
             <td>{!! $appadvertising->id !!}</td>
             <td>{!! $appadvertising->project->name !!}</td>
             <td>{!! $appadvertising->creator->name !!}</td>
             <td><img src="{!! $appadvertising->thumbnail !!}" width="160px" theme="dark" ></td>
             <td>{!! $appadvertising->interval !!}</td>
             <td><nobr>
                    <form name="appadvertising-delete-form" action="{{ route('appadvertisings.destroy', $appadvertising->id); }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('appadvertisings.edit', $appadvertising->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('appadvertisings.show', $appadvertising->id); }}'" >
                    </x-adminlte-button>
                    </form>
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
    </div>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

