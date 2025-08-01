<li class="sidebar__list-item {{ $active ? 'sidebar__list-item--active' : '' }}">
    <a href="{{ !empty($link) ? $link : '#' }}" class="sidebar__list-link">
        @if ($icon) <span class="icon icon-{{ $icon }}"></span> @endif
        <span>{{ $name }}</span>
    </a>
</li>
