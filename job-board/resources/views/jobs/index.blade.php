<x-layout>
    <x-breadcrums :links="['Jobs' => route('jobs.index')]"/>
    <div x-data="" class="mb-4 rounded-md border border-gray-300 bg-white p-4 text-sm shadow-sm">
        <form x-ref="filter" action="{{ route('jobs.index') }}" method="GET">
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input name="search" value="{{ request('search') }}" placeholder="Search for anything" form-ref="filter"/>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input name="min_salary" value="{{ request('min_salary') }}" placeholder="From" form-ref="filter"/>
                        <x-text-input name="max_salary" value="{{ request('max_salary') }}" placeholder="To" form-ref="filter"/>
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
            <x-button class="w-full">Filter</x-button>
        </form>
        </div>
    @foreach($jobs as $job)
        <x-card class="mb-4" :$job>
            <x-button :href="route('jobs.show', $job)">
                Show more
            </x-button>
        </x-card>
    @endforeach
</x-layout>
