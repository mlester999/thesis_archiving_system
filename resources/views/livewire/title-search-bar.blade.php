<div x-cloak x-data="{ searchTab: true }" class="relative">
    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <input 
            type="text" 
            x-cloak
            x-on:click="searchTab = true"
            x-on:click.outside="searchTab = false"
            x-on:keydown="searchTab = true"
            x-on:keydown.escape="searchTab = false"
            x-on:keydown.tab="searchTab = false"
            wire:keydown.ArrowUp="decrementHighlight"
            wire:keydown.ArrowDown="incrementHighlight"
            id="search" 
            name="search" 
            class="block p-4 pl-10 pr-24 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500" placeholder="Search for Topics..."
            wire:model="query"
            autocomplete="off"
        />

            <button type="submit" class="text-white duration-200 absolute right-2.5 bottom-2.5 bg-blue-600 hover:bg-opacity-80 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button> 
    
    @if(!empty($query))
        <div x-cloak x-show="searchTab" class="absolute z-50 bg-white w-full rounded-t-none shadow-lg">
            @if(!empty($titles))
                    @foreach($titles as $i => $title)
                        @php
                            $departmentData = App\Models\Department::find($title['department_id']);
                        @endphp
                        <a href="{{ route('view.department', [strtolower($departmentData->dept_name),  $title['archive_code']]) }}" class="py-4 px-8 hover:bg-slate-200 hover:text-opacity-70 duration-150 text-sm text-left font-semibold text-blue-500 tracking-normal flex {{ $highlightIndex == $i ? 'bg-slate-100' : '' }}"> {{ $title['title'] }} </a>
                    @endforeach
            @else
            <div class="py-4 px-8 text-sm text-left font-semibold text-black tracking-normal flex">No Topics Found...</div>
            @endif
        </div>
    @endif  
</div>
