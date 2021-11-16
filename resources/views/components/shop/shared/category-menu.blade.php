<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">Danh Mục</a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        @foreach ($categories as $parent)
            @if (count($parent->children) == 0)
                <li><a class="dropdown-item"
                        href="{{ route('product-by-category', $parent->slug) }}">{{ $parent->title }}</a></li>
            @else
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle"
                        href="{{ route('product-by-category', $parent->slug) }}">{{ $parent->title }}</a>
                    <ul class="dropdown-menu">
                        @foreach ($parent->children as $child)
                            <li>
                                <a class="dropdown-item" href="<?php echo route('product-by-category', $child->slug); ?>">{{ $child->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>
</li>
