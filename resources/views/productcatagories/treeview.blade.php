    <div class="row col-12">
      <div class="card-group col-md-12">
        <x-adminlte-card title="{{ __('productcatagories.table_name') }}" icon="fas fa-lg fa-cog text-primary"
          theme="primary" icon-theme="white" fgroup-class="col-md-6" >
          <ul id="tree1">
            @foreach($productcatagories as $category)
              <li>
                 <a href="{{ route('productcatagories.edit', $category->id) }}">{{ $category->name }}</a>
                 @if(count($category->childs()))
                   @include('productcatagories.manageChild', ['childs' => $category->childs()])
                 @endif
              </li>
            @endforeach
          </ul>
        </x-adminlte-card>
        @if (auth()->user()->canCreate(App\Enums\Content::ProductCatagory))
        <x-adminlte-card title="{{ __('tables.new').__('productcatagories.table_name') }}" icon="fas fa-lg fa-cog text-primary"
          theme="teal" icon-theme="white" fgroup-class="col-md-6" >
            @include('productcatagories.create')
        </x-adminlte-card>
        @endif
      </div>
    </div>
<link href="/css/treeview.css" rel="stylesheet">
<script src="/js/treeview.js"></script>

