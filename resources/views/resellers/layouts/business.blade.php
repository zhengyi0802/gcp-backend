<x-adminlte-card title="{{ __('resellers.business') }}" icon="fas fa-lg fa-cog text-primary"
   theme="teal" icon-theme="white">
   <a class="btn btn-success" href="{{ route('resellers.create', ['p' => 'business', 'project_id' => $collection->project_id]) }}" >
     {{ __('tables.new') }}
   </a>
   <div data-ride="carousel" class="carousel slide" data-interval="3000" id="business" >
   <div class="carousel-inner">
@php
  $active=true;
@endphp
   @foreach($collection->businesses as $business)
     <div class="carousel-item {{ $active ? 'active' : null }}" >
       <a href="{{ route('resellers.show', ['p' => 'business', 'reseller' => $business->id]) }}">
         <img src="{{ $business->logo_url }}" class="d-block w-100"  width="100%">
       </a>
       <a class="btn btn-success" href="{{ route('resellers.edit', ['p' => 'business', 'reseller' => $business->id]) }}" >
         {{ __('tables.edit') }}
       </a>
      </div>
@php
  $active = false;
@endphp
   @endforeach
     </div>
   </div>
</x-adminlte-card>
