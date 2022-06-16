@extends('adminlte::page')

@section('title', __('users.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('users.table_name').__('tables.detail') }}</h1>
@stop

@section('content')
    <div class="row col-12">
        <div class="card">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('permissions.index'); }}">{{ __('tables.back') }}</a>
            </div>
        </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('users.name') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $user->name }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('users.email') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       {{ $user->email }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('users.role') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
          @if ($user->role == App\Enums\UserRole::Administrator)
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
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
      <x-adminlte-card title="{{ __('users.permission') }}" icon="fas fa-lg fa-cog text-primary"
       theme="teal" icon-theme="white">
       <table width="100%">
         @foreach($user->permissions as $permission)
         <tr>
           <td width="20%" >{!! trans_choice('permissions.content', $permission->content_id) !!}</td>
           <td width="10%" >{!! $permission->canRead() ? __('permissions.read') : null !!}</td>
           <td width="10%" >{!! $permission->canCreate() ? __('permissions.create') : null !!}</td>
           <td width="10%" >{!! $permission->canUpdate() ? __('permissions.update') : null !!}</td>
           <td width="10%" >{!! $permission->canDisable() ? __('permissions.disable') : null !!}</td>
           <td width="10%" >{!! $permission->canDelete() ? __('permissions.delete') : null !!}</td>
           <td width="10%" >{!! $permission->canAudit() ? __('permissions.audit') : null !!}</td>
           <td>
             <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
               onClick="window.location='{{ route('permissions.edit', $permission->id); }}'" >
             </x-adminlte-button>
           </td>
         </tr>
         @endforeach
      </x-adminlte-card>
      </div>
    </div>
  </div>
@stop
