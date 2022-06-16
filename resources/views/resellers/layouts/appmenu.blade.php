<x-adminlte-card title="{{ __('resellers.appmenu') }}" icon="fas fa-lg fa-cog text-primary" theme="teal" icon-theme="white">
<table rows="3" cols="3" >
    @for($j=0; $j<3; $j++)
    <tr class="col-md-12" height="120px">
        @for($i=0; $i<3; $i++)
        <td width="128px">
@php
    $pos = $j * 3 + $i + 1;
@endphp
            @if (isset($collection->appmenus) && isset($collection->appmenus->array[$j * 3 + $i + 1]))
            <img onclick="editFrame({{ $pos }})"
              src="{{ $collection->appmenus->array[$pos]->apk->icon }}" width="128px" height="128px">
            @else
            <x-adminlte-button id="button" label="{{ $pos }}" theme="primary" icon="fas fa-hashtag"
              onclick="createFrame({{ $pos }})" style="width:128px; height:128px">
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
</x-adminlte-card>
