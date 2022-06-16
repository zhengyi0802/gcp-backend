@if ($collection->businesses->count() == 0)
      <x-adminlte-button id="button" label="{{ __('frontendviews.cust_logo') }}"
        theme="primary" style="width:100%; height:100px;" onClick="editBusiness()" />
@else
<div data-ride="carousel" class="carousel slide" data-interval="5000" id="business" >
  <div class="carousel-inner">
@php
      $active=true;
@endphp
      @foreach($collection->businesses as $business)
        <div class="carousel-item {{ $active ? 'active' : null }}" >
          <a href="{{ route('resellers.show', ['p' => 'business', 'reseller' => $business->id]) }}">
            <img src="{{ $business->logo_url }}" class="d-block w-100"  width="90%" height="80px">
          </a>
        </div>
@php
      $active = false;
@endphp
      @endforeach
  </div>
</div>
@endif

