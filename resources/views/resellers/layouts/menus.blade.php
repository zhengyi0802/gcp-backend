<x-adminlte-card title="{{ __('resellers.menu') }}" icon="fas fa-lg fa-cog text-primary"
   theme="teal" icon-theme="white">
   <a class="btn btn-success" href="{{ route('resellers.create', ['p' => 'menu', 'project_id' => $collection->project_id]) }}" >
     {{ __('tables.new') }}
   </a>
   <table col="2" width="100%">
   @foreach($collection->menus as $menu)
       <tr>
          <td width="70%">{{ ($menu->name) }}</td>
          <td width="30%"><a class="btn btn-success" href="{{ route('resellers.edit', ['p' => 'menu', 'reseller' => $menu->id]) }}" >
              {{ __('tables.edit') }}
              </a>
              <a class="btn btn-success" href="{{ route('resellers.show', ['p' => 'menu', 'reseller' => $menu->id]) }}" >
              {{ __('tables.detail') }}
              </a>
          </td>
       </tr>
   @endforeach
   </table>
</x-adminlte-card>
