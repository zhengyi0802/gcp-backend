@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('profile.change_password') }}</h1>
@stop

@section('messages')
    @if ($message = Session::get('success'))
    <x-adminlte-info-box title="{{ __('profile.success_message') }}" text="{{ __('profile.success_changep') }}" icon="far >
    @endif
    @if ($message = Session::get('error1'))
    <x-adminlte-info-box title="{{ __('profile.error_message') }}" text="{{ __('profile.error1_changep') }}" icon="far >
    @endif
    @if ($message = Session::get('error2'))
    <x-adminlte-info-box title="{{ __('profile.error_message') }}" text="{{ __('profile.error2_changep') }}" icon="far >
    @endif
    @if ($message = Session::get('error3'))
    <x-adminlte-info-box title="{{ __('profile,error_message') }}" text="{{ __('profile.error3_changep') }}" icon="far >
    @endif
    @if ($message = Session::get('error4'))
    <x-adminlte-info-box title="{{ __('profile.error_message') }}" text="{{ __('profile.error4_changep') }}" icon="far >
    @endif
@stop

@section('content')
    <div class="row col-12">
    <form action="{{ route('profiles.changepassword'); }}" method="POST" >
    @csrf
    <x-adminlte-card title="{{ __('profile.change_password') }}" theme="primary" theme-mode="full" icon="fas fa-lg fa-bell" 
        fg-class="col-md-12" >
        <x-adminlte-input name="password_current" type="password" label="{{ __('profile.old_password') }}"  />
        <x-adminlte-input name="password_new" type="password" label="{{ __('profile.new_password') }}"  />
        <x-adminlte-input name="password_confirm" type="password" label="{{ __('profile.retry_password') }}" />
        <x-adminlte-button class="d-flex ml-auto" type="submit" theme="light" label="{{ __('forms.submit') }}" icon="fas fa-sign-in"/>
    </x-adminlte-card>
    </form>
    @yield('messages')
    </div>
@stop
