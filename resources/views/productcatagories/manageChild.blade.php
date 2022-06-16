<ul>
  @foreach($childs as $child)
    <li>
      {{ $child->name }}
      @if(count($child->childs()))
        @include('productcatagories.manageChild', ['childs' => $child->childs()])
      @endif
    </li>
  @endforeach
</ul>

