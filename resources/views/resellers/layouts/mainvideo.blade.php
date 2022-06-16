<x-adminlte-card title="{{ __('resellers.mainvideo') }}" icon="fas fa-lg fa-cog text-primary"
   theme="teal" icon-theme="white">
   <a class="btn btn-success" href="{{ route('resellers.create', ['p' => 'mainvideo', 'project_id' => $collection->project_id]) }}" >
     {{ __('tables.new') }}
   </a>
   @foreach($collection->mainvideos as $mainvideo)
       <pre>{{ ($mainvideo->playlists()) }}</pre>
       <a class="btn btn-success" href="{{ route('resellers.edit', ['p' => 'mainvideo', 'reseller' => $mainvideo->id]) }}" >
         {{ __('tables.edit') }}
       </a>
       <a class="btn btn-success" href="{{ route('resellers.show', ['p' => 'mainvideo', 'reseller' => $mainvideo->id]) }}" >
         {{ __('tables.detail') }}
       </a>
   @endforeach
</x-adminlte-card>
