<x-layout>

    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index')]" />

    <x-card class="mb-4 text-sm" x-data="">
        <form x-ref="filters" id="filtering-form" action="{{ route('jobs.index') }}" method="GET">
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input form-id="filtering-form" name="search" value="{{ request('search') }}"
                        placeholder="Search for any text" form-ref="filters" />
                </div>
                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input form-id="filtering-form" name="min_salary" value="{{ request('min_salary') }}"
                            placeholder="From" form-ref="filters" />
                        <x-text-input form-id="filtering-form" name="max_salary" value="{{ request('max_salary') }}"
                            placeholder="To" form-ref="filters" />
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Experience</div>
                    <x-radio-group name="experience" :options="array_combine(
                        array_map('ucfirst', \App\Models\Job::$experience),
                        \App\Models\Job::$experience,
                    )" />
                </div>
                <div>
                    <div class="mb-1 font-semibold">Category</div>
                    <x-radio-group name="category" :options="array_combine(
                        array_map('ucfirst', \App\Models\Job::$category),
                        \App\Models\Job::$category,
                    )" />
                </div>
            </div>
            <x-button class="w-full">Filter</x-button>
        </form>
    </x-card>

    @foreach ($jobs as $job)
        <x-job-card class="mb-4" :$job>
            <div>
                <x-link-button :href="route('jobs.show', $job)">
                    Show
                </x-link-button>
            </div>
        </x-job-card>
    @endforeach


    <div class="mt-6 mb-8">
        <ul class="flex justify-center space-x-2">

            <li>
                @if ($jobs->onFirstPage())
                    <span class="px-4 py-2 text-slate-400 bg-slate-300 rounded-lg cursor-not-allowed">
                        Previous
                    </span>
                @else
                    <a href="{{ $jobs->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}"
                        class="px-4 py-2 text-white bg-slate-600 rounded-lg hover:bg-slate-700">
                        Previous
                    </a>
                @endif
            </li>


            @foreach ($jobs->getUrlRange(1, $jobs->lastPage()) as $page => $url)
                <li>
                    <a href="{{ $url . '&' . http_build_query(request()->except('page')) }}"
                        class="px-4 py-2 rounded-lg
                         {{ $page == $jobs->currentPage()
                             ? 'bg-gray-800 text-white'
                             : 'bg-slate-400 text-slate-800 hover:bg-slate-500 hover:text-white' }}">
                        {{ $page }}
                    </a>
                </li>
            @endforeach


            <li>
                @if ($jobs->hasMorePages())
                    <a href="{{ $jobs->nextPageUrl() . '&' . http_build_query(request()->except('page')) }}"
                        class="px-4 py-2 text-white bg-slate-600 rounded-lg hover:bg-slate-700">
                        Next
                    </a>
                @else
                    <span class="px-4 py-2 text-slate-400 bg-slate-300 rounded-lg cursor-not-allowed">
                        Next
                    </span>
                @endif
            </li>
        </ul>
    </div>




</x-layout>
