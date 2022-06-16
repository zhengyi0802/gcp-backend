<div class="container" style="border:2px solid #ccc;">
     <marquee behavior="scroll" direction="left">
     @foreach ($collection->marquees as $marquee)
        @if ($marquee->type == 2)
        <label><h2>{{ $marquee->content }}</h2></label>
        @endif
     @endforeach
     </marquee>
</div>
