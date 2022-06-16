@php
$heads = [
    __('users.index'),
    __('users.name'),
    __('users.email'),
    __('users.role'),
    __('users.created_by'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 5],
];
$config = [
    'columns' => [null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp

<x-adminlte-datatable id="permission-table" :heads="$heads" :config="$config" theme="info" striped hoverable>
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
     <td>{!! $user->creator->name !!}</td>
     <td><nobr>
        <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
          onClick="window.location='{{ route('permissions.show', $user->id); }}'" >
        </x-adminlte-button>
     </nobr></td>
   </tr>
   @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
