@php
$heads = [
    ['label' =>__('projects.index'), 'width' => 10],
    __('projects.name'),
    __('projects.company'),
    __('projects.created_by'),
    __('projects.start_time'),
    __('projects.stop_time'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
<x-adminlte-datatable id="project-table" :heads="$heads" :config="$config" theme="info" striped hoverable >
  @foreach($projects as $project)
    <tr>
      <td>{!! $project->id !!}</td>
      <td>{!! $project->name !!}</td>
      <td>{!! $project->company !!}</td>
      <td>{!! $project->creator->name !!}</td>
      <td>{!! $project->start_time !!}</td>
      <td>{!! $project->stop_time !!}</td>
      <td><nobr>
          <form name="project-delete-form" action="{{ route('projects.destroy', $project->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if ($project->created_by != 1)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('projects.edit', $project->id); }}'" >
              </x-adminlte-button>
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" >
              </x-adminlte-button>
             @endif
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('projects.show', $project->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

