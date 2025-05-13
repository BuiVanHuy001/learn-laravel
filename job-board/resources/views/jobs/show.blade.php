<x-layout>
    <x-breadcrumbs :links="['Jobs' => route('jobs.index'), $job->title => '#']"/>
    <x-card :$job>
        <p class="mb-4 text-sm text-slate-500">{{nl2br($job->description)}}</p>
        @can('apply', $job)
            <x-link-button class="w-full" href="{{ route('job.application.create', $job) }}">
                Apply for this job
            </x-link-button>
        @else
            <p class="text-md text-slate-500 font-bold">You have already applied for this job.</p>
        @endcan
    </x-card>
    <div class="mb-4 rounded-md border border-gray-300 bg-white p-4 shadow-sm">
        <h2 class="text-lg font-semibold mb-4">More jobs from {{ $job->employer->company_name }}</h2>
        @foreach($job->employer->jobs as $otherJob)
            <div class="flex justify-between mb-3 items-center">
                <div>
                    <a href="{{ route('jobs.show', $otherJob) }}" class="block text-md font-semibold text-slate-700 hover:text-slate-300">
                        {{ $otherJob->title }}
                    </a>
                    <div class="text-xs text-slate-500">
                        {{ $otherJob->created_at->diffForHumans() }} - {{ $otherJob->location }}
                    </div>
                </div>
                <div class="text-xs text-slate-500">
                    $ {{ number_format($otherJob->salary) }}
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
