<div class="content-1">
    @foreach($cats as $cat)
        <div class="nav-pill">
            <a
                @if(!isset($adds))
                    href="{{ url('firms/cat/' . $cat->id) }}"
                @endif
                class="nav-pill-title">{{ $cat->title }}</a>
                <div class="nav-pill-links">
                    @if(isset($adds))
                        @foreach($cat->sub as $sub)
                            <a class="nav-pill-link" href="{{ url($module . '/cat/' . $sub->id)}}">{{ $sub->title }}</a>
                        @endforeach
                    @endif
                </div>
        </div>
    @endforeach
</div>