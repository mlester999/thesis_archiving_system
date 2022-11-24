@extends('master')
@section('user')

  @php
      $showEmptyMessage = 0;
  @endphp

<div class="rounded-lg max-w-md sm:max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-7xl mx-auto my-8 relative">
  <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
  <div class="flex justify-between">
    <div class="flex flex-col">
      <h1 class="inline-block text-2xl md:text-3xl font-bold mb-4">List of Projects / Thesis / Capstone</h1> 
      @if(count($searches) >= 5)
        @livewire('suggest-topics')
      @endif
    </div>
    <form action="{{ url('projects') }}" method="get">   
    <div class="relative mb-8 max-w-xl ml-auto">
      @livewire('title-search-bar', ['currentPage' => $currentPage])
    </div>
  </div>
</form>
    <div class="border-t border-gray-200 shadow-xl rounded-lg">
        <div class="mb-10">
            <div class="flex flex-col">
              <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                  <div class="overflow-hidden md:rounded-lg">
                    @livewire('student-projects')
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
        class="flex flex-col xs:flex-row xs:justify-between pb-8"
        >	
        {{ $archiveData->links() }}
        </div>
      </div>
@endsection