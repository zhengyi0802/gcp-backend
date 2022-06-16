    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-card title="{{ __('apkcatagories.table_name') }}" icon="fas fa-lg fa-cog text-primary"
          theme="primary" icon-theme="white" fgroup-class="col-md-6" >
          <ul id="tree1">
            @foreach($apkcatagories as $category)
             @if ($category->parent_id == 0)
                 <li>
                     <a href="{{ route('apkcatagories.edit', $category->id); }}" >{{ $category->name }}</a>
                     @if(count($category->childs))
                       @include('apkcatagories.manageChild', ['childs' => $category->childs])
                     @endif

                 </li>
              @endif
            @endforeach
          </ul>
        </x-adminlte-card>
        <x-adminlte-card title="{{ __('tables.new').__('apkcatagories.table_name') }}" icon="fas fa-lg fa-cog text-primary"
          theme="teal" icon-theme="white" fgroup-class="col-md-6" >
            @include('apkcatagories.create2')
        </x-adminlte-card>
      </div>
    </div>
<link href="/css/treeview.css" rel="stylesheet">
<script src="/js/treeview.js"></script>
