@php
$heads = [
    ['label' =>__('apkprograms.index'), 'width' => 10],
    __('apkprograms.label'),
    __('apkprograms.icon'),
    __('apkprograms.version_name'),
    __('apkprograms.sdk_version'),
    __('apkprograms.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, ['orderable' => false], ['orderable' => false], ['orderable' => false], null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
      <x-adminlte-datatable id="table3" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($apkprograms as $apkprogram)
           <tr>
             <td>{!! $apkprogram->id !!}</td>
             <td>{!! $apkprogram->label !!}</td>
             <td><img src="{!! $apkprogram->icon !!}" width="128px"></td>
             <td>{!! $apkprogram->package_version_name !!}</td>
             <td>{!! $apkprogram->sdk_version !!}</td>
             <td>{!! ($apkprogram->created_by != null) ? $apkprogram->creator->name : null !!}</td>
             <td><nobr>
                 @if ($apkprogram->id != null)
                    <form name="apkprogram-delete-form" action="{{ route('apkprograms.destroy', $apkprogram->id); }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('apkprograms.edit', $apkprogram->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('apkprograms.show', $apkprogram->id); }}'" >
                    </x-adminlte-button>
                    </form>
                  @endif
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

