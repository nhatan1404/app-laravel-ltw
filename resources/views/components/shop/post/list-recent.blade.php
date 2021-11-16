@props([
    'name' => 'Bài Viết Gần Đây',
])

<div class="sidebar-box ftco-animate">
    <h3 class="heading">{{ $name }}</h3>
    @foreach ($posts as $post)
        <x-Shop.Post.ItemRecent :post="$post" />
    @endforeach
</div>
