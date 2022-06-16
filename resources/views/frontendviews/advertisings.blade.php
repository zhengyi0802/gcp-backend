@if ($collection->advertisings->count() == 0)
<x-adminlte-button id="button" label="{{ __('frontendviews.advertising') }}"
  theme="warning" style="width:100%; height:240px;" onClick="editAdvertising()" />
@else
<div data-ride="carousel" class="carousel slide" data-interval="3000" id="business" >
  <div class="carousel-inner">
@php
      $active=true;
@endphp
      @foreach($collection->advertisings as $advertising)
        <div class="carousel-item {{ $active ? 'active' : null }}" >
          <a href="{{ route('resellers.show', ['p' => 'advertising', 'reseller' => $advertising->id]) }}">
            <img src="{{ $advertising->thumbnail }}" class="d-block w-100"  width="90%" height="210px">
          </a>
        </div>
@php
      $active = false;
@endphp
      @endforeach
  </div>
</div>
@endif

