@if ($collection->bulletins->count() == null)
<x-adminlte-button id="button" label="{{ __('frontendviews.bulletin') }}"
  theme="primary" style="height:80px" onCLick="editBulletin()" />
@else
@php
      $active=true;
@endphp
<div data-ride="carousel" class="carousel slide" data-interval="4000" id="business" >
  <div class="carousel-inner">
      @foreach($collection->bulletins as $bulletin)
    <div class="carousel-item {{ $active ? 'active' : null }}" >
        <x-adminlte-callout title="{{ $bulletin->title }}"
          onCLick="javascript:window.location='{{ route('resellers.show', ['p' => 'bulletin', 'reseller' => $bulletin->id]) }}';" >
          <h6>{{ mb_substr($bulletin->message, 0, 8); }}</h6>
        </x-adminlte-callout>
    </div>
@php
      $active = false;
@endphp
      @endforeach
  </div>
</div>
@endif
