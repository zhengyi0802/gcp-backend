@extends('adminlte::page')

@section('title', __('users.page_title'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('users.table_name').__('tables.edit') }}</h1>
@stop

@section('content')
    <form id="user-project-form" action="{{ route('users.project.storepermission') }}" method="POST">
    @csrf
    <input name="user_id" value="{{ $user->id }}" type="hidden" >
    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-input name="email" label="{{ __('users.email') }}" fgroup-class="col-md-6"
          value="{{ $user->email  }}" disabled />
        <x-adminlte-select name="project_id" label="{{ __('users.project') }}" fgroup-class="col-md-6" >
          @foreach($projects as $project)
          <option value="{{ $project->id }}" >
           {{ $project->name }}
          </option>
          @endforeach
        </x-adminlte-select>
      </div>
    </div>
    <div class="row col-12">
      <div class="card-group col-md-12">
        <table cols="5" width="100%">
          <tr>
            <td width="20%" >
               <x-adminlte-input-switch name="perm_read" label="{{ __('permissions.read') }}" checked />
            </td>
            <td width="20%" >
               <x-adminlte-input-switch name="perm_create" label="{{ __('permissions.create') }}" />
            </td>
            <td width="20%" >
               <x-adminlte-input-switch name="perm_update" label="{{ __('permissions.update') }}" />
           </td>
            <td width="20%" >
               <x-adminlte-input-switch name="perm_disable" label="{{ __('permissions.disable') }}" />
            </td>
            <td >
               <x-adminlte-input-switch name="perm_audit" label="{{ __('permissions.audit') }}" />
            </td>
          </tr>
        </table>
      </div>
    </div>
    <div class="row col-12">
        <x-adminlte-textarea name="description" label="{{ __('users.description') }}" rows=5 fgroup-class="col-md-12"
           igroup-size="sm" placeholder="Insert description...">
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
          onClick="window.location='{{ url()->previous(); }}'" />
    </div>
    </form>
@stop
@section('plugins.BootstrapSwitch', true)
