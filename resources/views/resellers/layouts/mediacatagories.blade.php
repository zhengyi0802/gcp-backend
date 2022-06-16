@foreach($collection->menus as $menu)
<div class="row col-12">
  <div class="card-group col-md-12">
    <x-adminlte-card title="{{ $menu->name }}" icon="fas fa-lg fa-cog text-primary"
      theme="teal" icon-theme="white">
      <table col="4" width="100%" style="table-layout: fixed;">
      <col style="width:25%;" />
      <col style="width:25%;" />
      <col style="width:25%;" />
      <col style="width:25%;" />
        @foreach($collection->menucontent($menu->id)->chunk(4) as $chunk)
        <tr>
          @foreach($chunk as $mediacatagory)
            <td>
             <img src="{{ $mediacatagory->thumbnail }}" width="80%" >
             <p>{{ $mediacatagory->name }}</p>
            </td>
          @endforeach
        </tr>
        @endforeach
      </table>
    </x-adminlte>
  </div>
</div>
@endforeach


