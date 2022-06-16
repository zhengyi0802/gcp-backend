<ul>
  @foreach($childs as $child)
    <li>
      <a href="{{ route('producttypes.edit', $child->id); }}" >{{ $child->name }}</a>
      @if(count($child->childs()))
        @include('producttypes.manageChild', ['childs' => $child->childs()])
      @endif
    </li>
  @endforeach
</ul>

