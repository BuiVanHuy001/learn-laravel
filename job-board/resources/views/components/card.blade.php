<article {{ $attributes->class('rounded-md mb-4 border border-gray-300 bg-white shadow-sm p-4') }}>
    <div class="mb-4 flex justify-between">
        <h2 class="text-lg font-medium">{{ $job->title }}</h2>
        <div class="text-slate-500">
            $ {{number_format($job->salary)}}
        </div>
    </div>
    <div class="mb-4 flex items-center justify-between text-sm text-slate-500">
        <div class="flex space-x-4">
            <div>{{ $job->company }}</div>
            <div>{{ $job->location }}</div>
        </div>
        <div class="flex text-xs space-x-1">
            <x-tag>
                <a href="{{ route('jobs.index', ['experience' => $job->experience]) }}">
                    {{ ucfirst($job->experience) }}
                </a>
            </x-tag>
            <x-tag>
                <a href="{{ route('jobs.index', ['category' => $job->category]) }}">
                    {{ ucfirst($job->category) }}
                </a>
            </x-tag>
        </div>
    </div>
    {{ $slot }}
</article>
