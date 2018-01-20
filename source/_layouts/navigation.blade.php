<ul class="px-8 mt-6 text-base">
    @foreach($page->navigation as $title => $link)
        <li class="leading-loose {{ $page->selected($link) ? 'font-medium' : 'font-light' }}">
            <a href="{{ $link }}">{{ $title }}</a>
        </li>
    @endforeach
</ul>
