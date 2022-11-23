<div>
<button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="viewSuggestedTopics()" class="text-slate-50 bg-blue-500 hover:bg-opacity-80 duration-150 rounded-full py-2 px-3 mb-2 ml-2 text-sm mr-auto">Suggested Topics</button>

{{-- Show View Modal --}}

<x-dialog-modal wire:model.defer="showViewModal">
    <x-slot name="title"><i class="fa-solid fa-magnifying-glass fa-md pr-4 text-gray-500"></i>{{ $logTitle }}</x-slot>

    <x-slot name="content">
      <div class="overflow-x-auto sm:rounded-lg space-y-8">
        <!--Body-->
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-slate-100">
              <tr>
                <th
                  scope="col"
                  class="tracking-widest py-4 px-8 text-xs sm:text-sm font-medium text-slate-800"
                >
                  #
                </th>
                <th
                  scope="col"
                  class="tracking-widest p-4 text-xs sm:text-sm font-medium text-slate-800"
                >
                  Topics
                </th>
                <th
                  scope="col"
                  class="tracking-widest p-4 text-xs sm:text-sm font-medium text-slate-800"
                >
                  Searches
                </th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
              @forelse($searches as $key => $search)
  
            <tr
                wire:loading.class="opacity-50"
                tabindex="{{ $search->id }}"
                class="odd:bg-white even:bg-slate-50 focus:outline-none h-16 text-xs md:text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
            >
            <td class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800">
                <p class="text-md font-medium leading-none text-gray-800">{{ $key + 1 }}</p>
            </td>
              <td class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800">
                <p class="text-md font-medium leading-none text-gray-800">{{ $topicsAvailability[$key] }}</p>
              </td>
              <td class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800">
                  <p class="text-md font-medium leading-none text-gray-800">{{ $sortedArr[$sortedArrKeys[$key]] }} {{$sortedArr[$sortedArrKeys[$key]] == 1 ? ' student looking for this topic.' : ' students looking for this topic.'}}</p>
                </td>
            </tr>
  
            @empty
            <tr
            wire:loading.class="opacity-50"
            class="odd:bg-white even:bg-slate-50 focus:outline-none h-26 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
          >
            <td colspan="7" class="pl-8">
              <div class="flex items-center justify-center">
                <div>
                  <p class="text-xl py-8 font-medium leading-none text-gray-400">No top search found...</p>
                </div>
              </div>
            </td>
          </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </x-slot>
    
        <x-slot name="footer">
            <x-secondary-button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click="$set('showViewModal', false)" class="mx-2">Cancel</x-secondary-button>
        </x-slot>
        </x-dialog-modal>	

</div>