@extends('adminlte::page')

@section('title', __('users.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('users.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="user-form" action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="email" label="{{ __('users.email') }}" fgroup-class="col-md-4"
          value="{{ $user->email }}" disabled />
        <x-adminlte-input name="name" label="{{ __('users.name') }}" fgroup-class="col-md-4"
          value="{{ $user->name }}" />
        <x-adminlte-input name="new-password" label="{{ __('users.password') }}" fgroup-class="col-md-4" type="password" />
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-select name="role" label="{{ __('users.role') }}" fgroup-class="col-md-4" >
             <option value="{{ App\Enums\UserRole::Administrator }}"
               {{ (auth()->user()->role > App\Enums\UserRole::Administrator) ? "disabled" : null }}
               {{ ($user->role == App\Enums\UserRole::Administrator) ? "selected" : null }} >
               {{ __('users.role_admin') }}
             </option>
             <option value="{{ App\Enums\UserRole::MainManager }}"
               {{ (auth()->user()->role > App\Enums\UserRole::MainManager) ? "disabled" : null }}
               {{ ($user->role == App\Enums\UserRole::MainManager) ? "selected" : null }} >
               {{ __('users.role_mainmanager') }}
             </option>
             <option value="{{ App\Enums\UserRole::Manager }}"
               {{ (auth()->user()->role > App\Enums\UserRole::Manager) ? "disabled" : null }}
               {{ ($user->role == App\Enums\UserRole::Manager) ? "selected" : null }} >
               {{ __('users.role_manager') }}
             </option>
             <option value="{{ App\Enums\UserRole::Operator }}"
               {{ (auth()->user()->role > App\Enums\UserRole::Manager) ? "disabled" : null }}
               {{ ($user->role == App\Enums\UserRole::Operator) ? "selected" : null }} >
               {{ __('users.role_operator') }}
             </option>
             <option value="{{ App\Enums\UserRole::Reseller }}"
               {{ (auth()->user()->role > App\Enums\UserRole::Manager) ? "disabled" : null }}
               {{ ($user->role == App\Enums\UserRole::Reseller) ? "selected" : null }} >
               {{ __('users.role_reseller') }}
             </option>
             <option value="{{ App\Enums\UserRole::Advertiser }}"
               {{ (auth()->user()->role > App\Enums\UserRole::Manager) ? "disabled" : null }}
               {{ ($user->role == App\Enums\UserRole::Advertiser) ? "selected" : null }} >
               {{ __('users.role_advertiser') }}
             </option>
             <option value="{{ App\Enums\UserRole::User }}"
               {{ (auth()->user()->role > App\Enums\UserRole::Manager) ? "disabled" : null }}
               {{ ($user->role == App\Enums\UserRole::User) ? "selected" : null }} >
               {{ __('users.role_user') }}
             </option>
        </x-adminlte-select>
        <x-adminlte-input name="company" label="{{ __('users.company') }}" fgroup-class="col-md-4"
          value="{{ $user->profile->company }}" />
        <x-adminlte-input name="title" label="{{ __('users.title') }}" fgroup-class="col-md-4"
          value="{{ $user->profile->job }}" />
      </div>
    </div>
    <div class="row col-12">
        <x-adminlte-textarea name="description" label="{{ __('users.description') }}" rows=5 fgroup-class="col-md-12"
           igroup-size="sm" placeholder="Insert description...">{{ $user->description }}
          <x-slot name="prependSlot">
            <div class="input-group-text bg-dark">
              <i class="fas fa-lg fa-file-alt text-warning"></i>
            </div>
          </x-slot>
       </x-adminlte-textarea>
    </div>
    <div class="row col-12">
        <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
        <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"
          onClick="window.location='{{ route('users.index'); }}'" />
    </div>
    </form>
@stop

