@php
$heads = [
    ['label' =>__('mediacatagories.index'), 'width' => 10],
    __('mediacatagories.option'),
    __('mediacatagories.project'),
    __('mediacatagories.parent'),
    __('mediacatagories.name'),
    __('mediacatagories.thumbnail'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
    <div class="row col-12">
      <x-adminlte-datatable id="mediacatagory-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
         @foreach($mediacatagories as $mediacatagory)
           <tr>
             <td>{!! $mediacatagory->id !!}</td>
             <td>@if ($mediacatagory->menu_id == 1)
                   {{ __('mediacatagories.option_elearning') }}
                 @elseif ($mediacatagory->menu_id == 2)
                   {{ __('mediacatagories.option_media') }}
                 @else
                   {{ __('mediacatagories.option_menu') }}
                 @endif
             </td>
             <td>{!! $mediacatagory->project->name !!}</td>
             <td>{!! ($mediacatagory->parent_id > 0) ? $mediacatagory->parent->name : __('mediacatagories.parent_root') !!}</td>
             <td>{!! $mediacatagory->name !!}</td>
             <td><img src="{!! $mediacatagory->thumbnail !!}" width="160px"></td>
             <td><nobr>
                    <form name="mediacatagory-delete-form" action="{{ route('mediacatagories.destroy', $mediacatagory->id); }}" method="POST">
                    @csrf
                    @method('DELETE')
                    @if ($mediacatagory->created_by != 2)
                    <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                        onClick="window.location='{{ route('mediacatagories.edit', $mediacatagory->id); }}'" >
                    </x-adminlte-button>
                    <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                        type="submit" >
                    </x-adminlte-button>
                    @endif
                    <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                        onClick="window.location='{{ route('mediacatagories.show', $mediacatagory->id); }}'" >
                    </x-adminlte-button>
                    </form>
             </nobr></td>
           </tr>
         @endforeach
      </x-adminlte-datatable>
    </div>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

