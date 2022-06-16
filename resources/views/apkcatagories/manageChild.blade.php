<ul>
  @foreach($childs as $child)
    <li>
      <a href="{{ route('apkcatagories.edit', $child->id); }}" >{{ $child->name }}</a>
      @if(count($child->childs))
        @include('apkcatagories.manageChild', ['childs' => $child->childs])
      @endif
    </li>
  @endforeach
</ul>

