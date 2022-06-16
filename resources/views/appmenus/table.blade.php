            <table rows="3" cols="3" >
               @for($j=0; $j<3; $j++)
               <tr class="col-md-12" height="120px">
                  @for($i=0; $i<3; $i++)
                  <td width="128px">
                    @if (isset($appmenus) && isset($appmenus[$j * 3 + $i + 1]))
                    <img onClick="editFrame({{ $appmenus[$j * 3 + $i + 1]->id }})" src="{{ $appmenus[$j * 3 + $i + 1]->apk->icon }}"
                     width="128px" height="128px">
                    @else
                    <x-adminlte-button id="button" label="{{ $j * 3 + $i + 1 }}" theme="primary" icon="fas fa-hashtag"
                       onClick="createFrame({{ $j * 3 + $i + 1 }})" style="width:128px; height:128px">
                    </x-adminlte-button>
                    @endif
                  </td>
                  @endfor
               </tr>
               @endfor
             </table>
             <script>
                 function createFrame(i) {
                    var dframe = document.getElementById("details");
                    var project = document.getElementById('project').value;
                    dframe.src = "appmenus/create?position=" + i + "&project_id=" + project;
                 }
                 function editFrame(i) {
                    var dframe = document.getElementById("details");
                    var project = document.getElementById('project').value;
                    dframe.src = "appmenus/" + i + "/edit";
                 }
             </script>

