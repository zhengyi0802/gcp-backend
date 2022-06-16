@php
$heads = [
    __('users.index'),
    __('users.name'),
    __('users.email'),
    __('users.role'),
    __('users.project'),
    __('users.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 5],
];
$config = [
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp

<x-adminlte-datatable id="table3" :heads="$heads" :config="$config" theme="info" striped hoverable>
    @foreach($users as $user)
    <tr>
      <td>{!! $user->id !!}</td>
      <td>{!! $user->name !!}</td>
      <td>{!! $user->email !!}</td>
      <td>@if ($user->role == App\Enums\UserRole::Administrator)
              {{ __('users.role_admin') }}
          @elseif ($user->role == App\Enums\UserRole::System)
              {{ __('users.role_system') }}
          @elseif ($user->role == App\Enums\UserRole::Developer)
              {{ __('users.role_developer') }}
          @elseif ($user->role == App\Enums\UserRole::MainManager)
              {{ __('users.role_mainmanager') }}
          @elseif ($user->role == App\Enums\UserRole::Manager)
              {{ __('users.role_manager') }}
          @elseif ($user->role == App\Enums\UserRole::Operator)
              {{ __('users.role_operator') }}
          @elseif ($user->role == App\Enums\UserRole::Reseller)
              {{ __('users.role_reseller') }}
          @elseif ($user->role == App\Enums\UserRole::Advertiser)
              {{ __('users.role_advertiser') }}
          @elseif ($user->role == App\Enums\UserRole::User)
              {{ __('users.role_user') }}
          @endif
     </td>
     <td> @if ($user->role <= App\Enums\UserRole::MainManager)
            <p>{{ __('projects.project_all') }}
          @else
            @foreach($user->projects() as $project)
             <p>{!! $project->name !!}</p>
            @endforeach
          @endif
     </td>
     <td>{!! $user->creator->name !!}</td>
     <td><nobr>
        <form name="user-delete-form" action="{{ route('users.destroy', $user->id); }}" method="POST">
        @csrf
        @method('DELETE')
        @if ($user->created_by != 1)
          <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
            onClick="window.location='{{ route('users.edit', $user->id); }}'" >
          </x-adminlte-button>
          <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
            type="submit" >
          </x-adminlte-button>
        @endif
        <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
          onClick="window.location='{{ route('users.show', $user->id); }}'" >
        </x-adminlte-button>
        </form>
     </nobr></td>
   </tr>
   @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

