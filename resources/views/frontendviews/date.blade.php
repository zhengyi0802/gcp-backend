<x-adminlte-button id="date" label="{{ __('frontendviews.date') }}"
  theme="dark" style="width:100%; height:40%" disabled />
<x-adminlte-button id="time" label="{{ __('frontendviews.date') }}"
  theme="dark" style="width:100%; height:40%" disabled />
<script>
var dt = new Date();
document.getElementById("date").innerHTML = "<b>"+dt.toLocaleDateString()+"</b>";
document.getElementById("time").innerHTML = dt.toLocaleTimeString();
</script>
