@if ($collection->logo == null)
<x-adminlte-button id="button" label="{{ __('frontendviews.logo') }}"
  theme="dark" style="width:100%; height:100%" disabled />
@else
<img src="{{ $collection->logo->image }}" width="90%" height="90%" style="background-colot: #000000;"  >
@endif
