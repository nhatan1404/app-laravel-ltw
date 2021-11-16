<div class="block-21 mb-4 d-flex">
    <a class="blog-img mr-4" style="background-image: url({{ $post->thumbnail }});"></a>
    <div class="text">
        <h3 class="heading-1"><a href="{{ route('posts-detail', $post->slug) }}">{{ $post->title }}</a></h3>
        <div class="meta">
            <div><a href="{{ route('posts-detail', $post->slug) }}"><span
                        class="icon-calendar mr-1"></span>{{ date('d/m/Y', strtotime($post->created_at)) }}</a>
            </div>
            <div><a href="{{ route('posts-detail', $post->slug) }}"><span
                        class="icon-person"></span>{{ $post->author->fullname }}</a></div>
            <div><a href="{{ route('posts-detail', $post->slug) }}"><span class="icon-chat"></span> 19</a>
            </div>
        </div>
    </div>
</div>
