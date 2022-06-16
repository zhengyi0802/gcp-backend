<x-adminlte-card title="{{ __('resellers.marquee') }}" icon="fas fa-lg fa-cog text-primary"
   theme="teal" icon-theme="white">
   <a class="btn btn-success" href="{{ route('resellers.create', ['p' => 'marquee', 'project_id' => $collection->project_id]) }}" >
     {{ __('tables.new') }}
   </a>
   <table col="3" width="100%">
   @foreach($collection->marquees as $marquee)
       <tr>
          <td>{{ ($marquee->content) }}</td>
          <td><a class="btn btn-success" href="{{ route('resellers.edit', ['p' => 'marquee', 'reseller' => $marquee->id]) }}" >
              {{ __('tables.edit') }}
              </a>
              <a class="btn btn-success" href="{{ route('resellers.show', ['p' => 'marquee', 'reseller' => $marquee->id]) }}" >
              {{ __('tables.detail') }}
              </a>
          </td>
       </tr>
   @endforeach
   </table>
</x-adminlte-card>
