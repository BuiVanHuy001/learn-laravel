<nav class="mb-4">
    <ul class="flex space-x-2 text-slate-500 font-semibold items-center">
        <li><a href="/">Home</a></li>
        @foreach($links as $label => $link)
            <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                </svg>
            </li>
            <li><a href="{{ $link }}">{{ $label }}</a></li>
        @endforeach
    </ul>
</nav>
