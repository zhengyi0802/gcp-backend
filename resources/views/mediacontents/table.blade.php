@php
$heads = [
    ['label' =>__('mediacontents.index'), 'width' => 10],
    __('mediacontents.catagory'),
    __('mediacontents.mime_type'),
    __('mediacontents.name'),
    __('mediacontents.preview'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
    <div class="row col-12">
      <x-adminlte-datatable id="table3" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($mediacontents as $mediacontent)
           <tr>
             <td>{!! $mediacontent->id !!}</td>
             <td>{!! $mediacontent->catagory->name !!}</td>
             <td>@if ($mediacontent->mime_type == 'i_video')
                     {{ __('mediacontents.type_video') }}
                 @elseif ($mediacontent->mime_type == 'e_video')
                     {{ __('mediacontents.type_external') }}
                 @elseif ($mediacontent->mime_type == 'youtube')
                     {{ __('mediacontents.type_youtube') }}
                 @endif
             </td>
             <td>{!! $mediacontent->name !!}</td>
             <td><img src="{!! $mediacontent->preview !!}" width="160px" height="90px"></td>
             <td><nobr>
                    <form name="mediacontent-delete-form" action="{{ route('mediacontents.destroy', $mediacontent->id); }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @if ($mediacontent->created_by != 2)
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('mediacontents.edit', $mediacontent->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    @endif
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('mediacontents.show', $mediacontent->id); }}'" >
                    </x-adminlte-button>
                    </form>
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
    </div>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

