<table rows="3" cols="3" width="100%" height="100%">
    @for($j=0; $j<3; $j++)
    <tr height="33%">
        @for($i=0; $i<3; $i++)
        <td width="33%">
@php
    $pos = $j * 3 + $i + 1;
@endphp
            @if (isset($collection->appmenus) && isset($collection->appmenus->array[$j * 3 + $i + 1]))
            <img onclick="editFrame({{ $pos }})"
              src="{{ $collection->appmenus->array[$pos]->apk->icon }}" width="80%" height="80%">
            @else
            <x-adminlte-button id="button" label="{{ $pos }}" theme="primary" icon="fas fa-hashtag"
              onclick="createFrame({{ $pos }})" style="width:100%; height:100%">
            </x-adminlte-button>
            @endif
        </td>
        @endfor
    </tr>
    @endfor
</table>
<script>
     function createFrame(i) {
        //alert(i);
        var url = "/resellers/create?p=appmenu&project_id={{ $collection->project_id }}&position=" + i;
        window.location = url;
     }
     function editFrame(i) {
        window.location="/resellers/{{ $collection->project_id }}/edit?p=appmenu&project_id={{ $collection->project_id }}&position=" + i;
     }
</script>
