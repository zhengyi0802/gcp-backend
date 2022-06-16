@php
$heads = [
    ['label' =>__('mainvideos.index'), 'width' => 10],
    __('mainvideos.project'),
    __('mainvideos.type'),
    __('mainvideos.playlist'),
    __('nainvideos.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
      <x-adminlte-datatable id="mainvideo-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($mainvideos as $mainvideo)
           <tr>
             <td>{!! $mainvideo->id !!}</td>
             <td>{!! $mainvideo->project->name !!}</td>
             <td>
               @if ($mainvideo->type == 'playlist')
               {{ __('mainvideos.type_playlist') }}
               @elseif ($mainvideo->type == 'youtube_playlist')
               {{ __('mainvideos.type_youtube_playlist') }}
               @elseif ($mainvideo->type == 'youtube_playlist_id')
               {{ __('mainvideos.type_youtube_playlist_id') }}
               @elseif ($mainvideo->type == 'stream')
               {{ __('mainvideos.type_stream') }}
               @endif
             </td>
             <td><pre>{!! $mainvideo->playlists() !!}</pre></td>
             <td>{!! $mainvideo->creator->name !!}</td>
             <td><nobr>
                    <form name="mainvideo-delete-form" action="{{ route('mainvideos.destroy', $mainvideo->id); }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('mainvideos.edit', $mainvideo->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('mainvideos.show', $mainvideo->id); }}'" >
                    </x-adminlte-button>
                    </form>
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
