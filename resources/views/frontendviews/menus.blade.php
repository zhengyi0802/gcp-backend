<x-adminlte-modal id="showMenu" title="{{ __('frontendviews.menu') }}" theme="teal" size="lg"
        icon="fas fa-bell" v-centered static-backdrop scrollable>
   <table col="3" width="100%">
   @foreach($collection->menus as $menu)
       <tr>
          <td>{{ ($menu->name) }}</td>
          <td></td>
          <td><a class="btn btn-success" href="{{ route('resellers.edit', ['p' => 'menu', 'reseller' => $menu->id]) }}" >
              {{ __('tables.edit') }}
              </a>
              <a class="btn btn-success" href="{{ route('resellers.show', ['p' => 'menu', 'reseller' => $menu->id]) }}" >
              {{ __('tables.detail') }}
              </a>
          </td>
       </tr>
   @endforeach
   </table>
 <x-slot name="footerSlot">
   <x-adminlte-button theme="danger" label="{{ __('tables.dismiss') }}" data-dismiss="modal"/>
 </x-slot>
</x-adminlte-model>
    <x-adminlte-button label="{{ __('frontendviews.menu') }}" data-toggle="modal" data-target="#showMenu" class="bg-teal"
     style="width:100%; height:100%;" theme="dark" />
