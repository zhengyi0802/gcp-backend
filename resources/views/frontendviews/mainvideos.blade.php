@if ($collection->mainvideos == null)
<x-adminlte-button id="button" label="{{ __('frontendviews.main_video') }}"
   theme="dark" style="height:100%" onClick="editMainVideo()" />
@else
<x-adminlte-button id="button" label="{{ __('frontendviews.main_video') }}"
   theme="dark" style="height:100%" onClick="editMainVideo()" />
@endif
