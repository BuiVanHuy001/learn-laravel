<x-layout>
   <x-breadcrums :links="['Jobs' => route('jobs.index'), $job->title => '#']" />
    <x-card :$job>
        <p class="mb-4 text-sm text-slate-500">{{nl2br($job->description)}}</p>
    </x-card>
</x-layout>
