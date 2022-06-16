@php
$heads = [
    ['label' =>__('logos.index'), 'width' => 10],
    __('logos.name'),
    __('logos.project'),
    __('logos.created_by'),
    __('logos.image'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns'  => [null, null, null, null, ['orderable' => false], ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
    <div class="row col-12">
      <x-adminlte-datatable id="logo-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($logos as $logo)
           <tr>
             <td>{!! $logo->id !!}</td>
             <td>{!! $logo->name !!}</td>
             <td>{!! $logo->project->name !!}</td>
             <td>{!! $logo->creator->name !!}</td>
             <td><img src="{!! $logo->image !!}" width="160px" theme="dark" ></td>
             <td><nobr>
                    <form name="logo-delete-form" action="{{ route('logos.destroy', $logo->id); }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @if ($logo->created_by != 2)
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('logos.edit', $logo->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    @endif
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('logos.show', $logo->id); }}'" >
                    </x-adminlte-button>
                    </form>
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
    </div>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
