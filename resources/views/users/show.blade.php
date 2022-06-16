@extends('adminlte::page')

@section('title', __('users.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('users.table_name').__('tables.detail') }}</h1>
@stop

@section('content')
    <div class="row col-12">
        <div class="card">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.index'); }}">{{ __('tables.back') }}</a>
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
      <x-adminlte-card title="{{ __('users.company') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $user->profile->company }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('users.title') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
        {{ $user->profile->job }}
      </x-adminlte-card>
      <x-adminlte-card title="{{ __('users.created_by') }}" icon="fas fa-lg fa-user text-primary"
       theme="teal" icon-theme="white">
       {{ $user->creator->name }}
      </x-adminlte-card>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-12">
       <x-adminlte-card title="{{ __('users.project') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         @if ($user->role <= App\Enums\UserRole::Developer || $user->role == App\Enums\UserRole::MainManager)
           <p>{{ __('projects.project_all') }}
         @else
           <a class="btn btn-success" href="{{ route('users.project.createpermission', ['user_id' => $user->id]); }}" >
             {{ __('tables.addproject') }}
           </a>
           <table name="user-projects-table" rols="2" >
             @foreach($user->projects() as $project)
               <tr>
                <td width="50%">{!! $project->name !!}</td>
                <td width="50%">
                  <a class="btn btn-success"
                    href="{{ route('users.project.editpermission', ['user_id' => $user->id, 'project_id' => $project->id]); }}">
                    {{ __('tables.permission') }}
                  </a>
                  <a class="btn btn-danger"
                    href="{{ route('users.project.removepermission', ['user_id' => $user->id, 'project_id' => $project->id]); }}">
                    {{ __('tables.killproject') }}
                  </a>
                </td>
               <tr>
             @endforeach
           </table>
         @endif
       </x-adminlte-card>
       <x-adminlte-card title="{{ __('users.description') }}"
         icon="fas fa-lg fa-clock text-primary" theme="warning" icon-theme="white">
         <pre>{{ $user->profile->description }}</pre>
       </x-adminlte-card>
    </div>
  </div>
@stop
