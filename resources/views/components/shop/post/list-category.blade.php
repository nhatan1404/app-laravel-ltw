<div class="sidebar-box ftco-animate">
    <h3 class="heading">Danh Mục Bài Viết</h3>
    <ul class="categories">
        @foreach ($categories as $category)
            <li><a href="{{ route('posts-by-category', $category->slug) }}">{{ $category->title }}</span></a>
            </li>
            @foreach ($category->children as $child)
                <li class="ml-2"><a
                        href="{{ route('posts-by-category', $child->slug) }}">{{ $category->title }}<span>{{ $child->total_posts }}</span></a>
                </li>
            @endforeach
        @endforeach
    </ul>
</div>
