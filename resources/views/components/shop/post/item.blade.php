<div class="col-md-12 d-flex ftco-animate">
    <div class="blog-entry align-self-stretch d-md-flex">
        <a href="{{ route('posts-detail', [$post->slug]) }}" class="block-20"
            style="background-image: url('{{ $post->thumbnail }}');">
        </a>
        <div class="text d-block pl-md-4">
            <div class="meta mb-3">
                <div><a href="{{ route('posts-detail', [$post->slug]) }}">{{ $post->updated_at }}-></a>
                </div>
                <div><a href="{{ route('posts-detail', [$post->slug]) }}">{{ $post->author->fullname }}</a>
                </div>
                <div><a href="{{ route('posts-detail', [$post->slug]) }}" class="meta-chat"><span
                            class="icon-chat"></span>
                        3</a>
                </div>
            </div>
            <h3 class="heading"><a href="{{ route('posts-detail', [$post->slug]) }}">{{ $post->title }}</a>
            </h3>
            <p>{{ $post->description }}</p>
            <p><a href="{{ route('posts-detail', [$post->slug]) }}" class="btn btn-primary py-2 px-3">Chi
                    tiết</a></p>
        </div>
    </div>
</div>
