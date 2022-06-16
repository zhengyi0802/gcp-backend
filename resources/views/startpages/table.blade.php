@php
$heads = [
    ['label' =>__('startpages.index'), 'width' => 10],
    __('startpages.name'),
    __('startpages.project'),
    __('startpages.url'),
    __('startpages.intervals'),
    __('startpages.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, ['orderable' => false], ['orderable' => false], null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
    <div class="row col-12">
      <x-adminlte-datatable id="table3" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($startpages as $startpage)
           <tr>
             <td>{!! $startpage->id !!}</td>
             <td>{!! $startpage->name !!}</td>
             <td>{!! $startpage->project->name !!}</td>
             <td>
                 @if ($startpage->mime_type == "image")
                     <img src="{!! $startpage->url !!}" width="320" height="180">
                 @elseif ($startpage->mime_type == "i_video" || $startpage->mime_type == "e_video")
                    <video width="320" height="180" controls>
                        <source src="{{ $startpage->url }}" type="video/mp4">
                    </video>
                 @else
                    <x-embed url="https://youtube.com/watch?v={{ $startpage->url }}" />
                 @endif
             </td>
             <td>{!! $startpage->intervals !!}</td>
             <td>{!! $startpage->creator->name !!}</td>
             <td><nobr>
                    <form name="startpage-delete-form" action="{{ route('startpages.destroy', $startpage->id); }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('startpages.edit', $startpage->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('startpages.show', $startpage->id); }}'" >
                    </x-adminlte-button>
                    </form>
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
    </div>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
