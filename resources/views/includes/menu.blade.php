@foreach($items as $item)
    <li {!! $item->attributes() !!}>
        {!! Func::menu_link($item, 1) !!}
        @if($item->hasChildren())
            <ul class="dropdown-menu">
                @foreach($item->children() as $child)
                    @if($child->hasChildren())
                    <li>
                    @else
                    <li>
                    @endif
                        {!! Func::menu_link($child, 2) !!}
                        @if($child->hasChildren())
                            <ul class="dropdown-menu">
                                @foreach($child->children() as $child2)
                                    <li>{!! Func::menu_link($child2, 3) !!}</li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
              </ul>
        @endif
    </li>

    @if($item->divider)
        <li{{\HTML::attributes($item->divider)}}></li>
    @endif
@endforeach