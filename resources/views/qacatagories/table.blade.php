<table cols="3" row="1" width="100%">
  <div class="card-group">
    <tr class="bg-info"><h2>
       <td class="text-center" width="20%">{{ $qacatagory->position }}</td>
       <td width="60%">{{ $qacatagory->name }}</td>
       <td width="20%"><nobr>
         <form name="qacatagory-delete-form" action="{{ route('qacatagories.destroy', $qacatagory->id); }}" method="POST">
         @csrf
         @method('DELETE')
         <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
            onClick="window.location='{{ route('qacatagories.edit', $qacatagory->id); }}'" >
         </x-adminlte-button>
         <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
            type="submit" >
         </x-adminlte-button>
         <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
            onClick="subFrame({{ $qacatagory->id }})" >
         </x-adminlte-button>
         </form></nobr>
       </td>
    </h2></tr>
  </div>
</table>
