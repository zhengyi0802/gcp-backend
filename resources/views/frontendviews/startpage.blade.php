<x-adminlte-card title="{{ __('resellers.startpage') }}" icon="fas fa-lg fa-cog text-primary"
   theme="teal" icon-theme="white">
@if ($collection->startpage == null)
   <a class="btn btn-success" href="{{ route('resellers.create', ['p' => 'menu', 'project_id' => $collection->project_id]) }}" >
     {{ __('tables.new') }}
   </a>
@elseif ($collection->startpage->mime_type == 'image')
   <a href="{{ route('resellers.show', ['p' => 'startpage', 'reseller' => $collection->startpage->id]) }}">
     <img src="{{ $collection->startpage->url }}" class="d-block w-100"  width="100%">
   </a>
   <a class="btn btn-success" href="{{ route('resellers.edit', ['p' => 'startpage', 'reseller' => $collection->startpage->id]) }}" >
     {{ __('tables.edit') }}
   </a>
@elseif ($collection->startpage->mime_type == 'i_video' || $collection->startpage->mime_type == 'e_video' )
   <a href="{{ route('resellers.show', ['p' => 'startpage', 'reseller' => $collection->startpage->id]) }}">
     <video width="100%" controls>
       <source src="{{ $collection->startpage->url }}" type="video/mp4">
     </video>
   </a>
   <a class="btn btn-success" href="{{ route('resellers.edit', ['p' => 'startpage', 'reseller' => $collection->startpage->id]) }}" >
     {{ __('tables.edit') }}
   </a>
@else
   <a href="{{ route('resellers.show', ['p' => 'startpage', 'reseller' => $collection->startpage->id]) }}">
     <x-embed-styles width="100%" />
     <x-embed url="https://youtube.com/watch?v={{ $collection->startpage->url }}" />
   </a>
@endif

</x-adminlte-card>
