@php
$heads = [
    ['label' =>__('advertisings.index'), 'width' => 10],
    __('advertisings.index2'),
    __('advertisings.project'),
    __('advertisings.created_by'),
    __('advertisings.thumbnail'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
    <div class="row col-12">
      <x-adminlte-datatable id="table3" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($advertisings as $advertising)
           <tr>
             <td>{!! $advertising->id !!}</td>
             <td>{!! $advertising->index !!}</td>
             <td>{!! $advertising->project->name !!}</td>
             <td>{!! $advertising->creator->name !!}</td>
             <td><img src="{!! $advertising->thumbnail !!}" width="160px" theme="dark" ></td>
             <td><nobr>
                    <form name="advertising-delete-form" action="{{ route('advertisings.destroy', $advertising->id); }}" 
                     method="POST">
                    @csrf
                    @method('DELETE')
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('advertisings.edit', $advertising->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('advertisings.show', $advertising->id); }}'" >
                    </x-adminlte-button>
                    </form>
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
    </div>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
