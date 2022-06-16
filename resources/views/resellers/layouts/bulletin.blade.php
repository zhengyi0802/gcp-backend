<x-adminlte-card title="{{ __('resellers.bulletin') }}" icon="fas fa-lg fa-cog text-primary"
  theme="teal" icon-theme="white">
  <a class="btn btn-success" href="{{ route('resellers.create', ['p' => 'bulletin', 'project_id' => $collection->project_id]) }}">
    {{ __('tables.new') }}
  </a>
  <table rols="2" width="100%">
    @foreach( $collection->bulletins as $bulletin)
    <tr>
      <td> <x-adminlte-card title="{{ $bulletin->title }}" icon="fas fa-lg fa-cog text-primary"
             theme="info" icon-theme="white">
             {{ $bulletin->message }}
           </x-adminlte-card>
      </td>
      <td><nobr>
          <a class="btn btn-success" href="{{ route('resellers.edit', ['p' => 'bulletin', 'reseller' => $bulletin->id]) }}" >
           {{ __('tables.edit') }}
          </a>
          <a class="btn btn-success" href="{{ route('resellers.show', ['p' =>'bulletin', 'reseller' => $bulletin->id]) }}" >
           {{ __('tables.detail') }}
          </a>
      </nobr></td>
    </tr>
    @endforeach
  </table>
</x-adminlte-card>
