<div class="post-sidebar">
    <div class="post-sidebar__block">
        <p class="post-sidebar__title">Derniers articles</p>
        <ul class="post-sidebar__listing">
            @foreach ($latest_posts as $latest_post)
                <li>
                    <a href="{{ route('posts.view', $latest_post->slug) }}">{{ $latest_post->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    @if ($categories->count() > 0)
        <div class="post-sidebar__block">
            <p class="post-sidebar__title">Categories</p>
            <ul class="post-sidebar__listing">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('posts.view-category', $category->slug) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
