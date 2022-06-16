    <form name="user-new-form" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-adminlte-modal id="newuser" title="{{ __('tables.new').__('users.table_name') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
        <div class="card-group">
           <x-adminlte-select name="role" label="{{ __('users.role') }}" fgroup-class="col-md-6" >
             <option value="{{ App\Enums\UserRole::Administrator }}"
               {{ (auth()->user()->role > App\Enums\UserRole::Administrator) ? "disabled" : null }} >
               {{ __('users.role_admin') }}
             </option>
             <option value="{{ App\Enums\UserRole::MainManager }}"
               {{ (auth()->user()->role > App\Enums\UserRole::MainManager) ? "disabled" : null }} >
               {{ __('users.role_mainmanager') }}
             </option>
             <option value="{{ App\Enums\UserRole::Manager }}"
               {{ (auth()->user()->role > App\Enums\UserRole::Manager) ? "disabled" : null }} >
               {{ __('users.role_manager') }}
             </option>
             <option value="{{ App\Enums\UserRole::Operator }}"
               {{ (auth()->user()->role > App\Enums\UserRole::Manager) ? "disabled" : null }} >
               {{ __('users.role_operator') }}
             </option>
             <option value="{{ App\Enums\UserRole::Manager }}"
               {{ (auth()->user()->role > App\Enums\UserRole::Reseller) ? "disabled" : null }} >
               {{ __('users.role_reseller') }}
             </option>
             <option value="{{ App\Enums\UserRole::Manager }}"
               {{ (auth()->user()->role > App\Enums\UserRole::Advertiser) ? "disabled" : null }} >
               {{ __('users.role_advertiser') }}
             </option>
             <option value="{{ App\Enums\UserRole::Manager }}"
               {{ (auth()->user()->role > App\Enums\UserRole::User) ? "disabled" : null }} >
               {{ __('users.role_user') }}
             </option>
           </x-adminlte-select>
           <x-adminlte-input name="name" label="{{ __('users.name') }}" fgroup-class="col-md-6" />
        </div>
        <div class="card-group">
           <x-adminlte-input name="email" label="{{ __('users.email') }}" fgroup-class="col-md-6" />
           <x-adminlte-input type="new-password" name="password" label="{{ __('users.password') }}" fgroup-class="col-md-6" />
        </div>
        <div class="card-group">
           <x-adminlte-input name="company" label="{{ __('users.company') }}" fgroup-class="col-md-6" />
           <x-adminlte-input name="job" label="{{ __('users.title') }}" fgroup-class="col-md-6" />
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
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="{{ __('tables.accept') }}" type="submit"/>
            <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-model>
    </form>
    <x-adminlte-button label="{{ __('tables.new') }}" data-toggle="modal" data-target="#newuser" class="bg-teal" />
