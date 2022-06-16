@php
$heads = [
    ['label' =>__('businesses.index'), 'width' => 10],
    __('businesses.serial'),
    __('businesses.project'),
    __('businesses.created_by'),
    __('businesses.logo_url'),
    __('businesses.intervals'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, ['orderable' => false], ['orderable' => false], ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
    <div class="row col-12">
      <x-adminlte-datatable id="business-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($businesses as $business)
           <tr>
             <td>{!! $business->id !!}</td>
             <td>{!! $business->serial !!}</td>
             <td>{!! $business->project->name !!}</td>
             <td>{!! $business->creator->name !!}</td>
             <td><img src="{!! $business->logo_url !!}" width="160px" theme="dark" ></td>
             <td>{!! $business->intervals !!}</td>
             <td><nobr>
                    <form name="business-delete-form" action="{{ route('businesses.destroy', $business->id); }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('businesses.edit', $business->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('businesses.show', $business->id); }}'" >
                    </x-adminlte-button>
                    </form>
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
    </div>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
