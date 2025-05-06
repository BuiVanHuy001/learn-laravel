<x-layout>
    <x-breadcrums :links="['Jobs' => route('jobs.index')]"/>
    <form action="{{ route('jobs.index') }}" method="GET">
        <div class="mb-4 rounded-md border border-gray-300 bg-white p-4 text-sm shadow-sm">
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" value="{{ request('search') }}" placeholder="Search for anything"/>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input name="min_salary" value="{{ request('min_salary') }}" placeholder="From" />
                        <x-text-input name="max_salary" value="{{ request('max_salary') }}" placeholder="To" />
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Experience</div>
                    <x-radio-group name="experience" :options="\App\Models\Job::$experiences"/>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Category</div>
                    <x-radio-group name="category" :options="\App\Models\Job::$categories"/>
                </div>
            </div>
            <button class="w-full">Filter</button>
        </div>
    </form>
    @foreach($jobs as $job)
        <x-card class="mb-4" :$job>
            <x-link-button :href="route('jobs.show', $job)">
                Show more
            </x-link-button>
        </x-card>
    @endforeach
</x-layout>
