@php
$heads = [
    ['label' =>__('bulletinitems.index'), 'width' => 10],
    __('bulletinitems.bulletin'),
    __('bulletinitems.mime_type'),
    __('bulletinitems.url'),
    __('bulletinitems.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
      <x-adminlte-datatable id="bulletinitem-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($bulletin->items as $bulletinitem)
           <tr>
             <td>{!! $bulletinitem->id !!}</td>
             <td>{!! $bulletinitem->bulletin->title.'('.$bulletinitem->bulletin->date.')' !!}</td>
             <td>{!! $bulletinitem->mime_type !!}
             </td>
             <td>
                 @if ($bulletinitem->mime_type == "image")
                     <img src="{!! $bulletinitem->url !!}" width="320" height="180">
                 @elseif ($bulletinitem->mime_type == "i_video" || $bulletinitem->mime_type == "e_video")
                    <x-embed url="{{ $bulletinitem->url }}" width="320" />
                 @else
                    <x-embed url="https://www.youtube.com/watch?v={{ $bulletinitem->url }}" />
                 @endif
             </td>
             <td>{!! $bulletinitem->creator->name !!}</td>
             <td><nobr>
                    <form name="bulletinitem-delete-form" action="{{ route('bulletinitems.destroy', $bulletinitem->id); }}" met>
                    @csrf
                    @method('DELETE')
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('bulletinitems.edit', $bulletinitem->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('bulletinitems.show', $bulletinitem->id); }}'" >
                    </x-adminlte-button>
                    </form>
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
