<table class="min-w-full divide-y divide-gray-300">
    <thead class="bg-slate-100">
      <tr>
        <th
          scope="col"
          class="p-4 tracking-widest text-sm font-medium text-slate-800"
        >
          Archive Code
        </th>
        <th
          scope="col"
          class="tracking-widest p-4 text-sm font-medium text-slate-800"
        >
          Project Title
        </th>
        <th
          scope="col"
          class="tracking-widest p-4 text-sm font-medium text-slate-800"
        >
          Project Year
        </th>
        <th
          scope="col"
          class="tracking-widest p-4 text-sm font-medium text-slate-800"
        >
          Research Agenda
        </th>
        <th
          scope="col"
          class="tracking-widest p-4 text-sm font-medium text-slate-800"
        >
          Department
        </th>
        <th
          scope="col"
          class="tracking-widest p-4 text-sm font-medium text-slate-800"
        >
          Curriculum
        </th>
        <th
          scope="col"
          class="tracking-widest p-4 text-sm font-medium text-slate-800"
        >
          Status
        </th>
        <th
          scope="col"
          class="tracking-widest p-8 text-sm font-medium text-slate-800"
        >
          Action
        </th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 bg-white" id="main-table-body">
      @forelse($archives as $archive)
      <tr wire:loading.class="opacity-50">
        <td
          class="whitespace-nowrap px-3 py-12 text-center text-sm font-medium tracking-wider text-slate-800"
        >
          {{ $archive->archive_code }}
        </td>

        <td
          class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800"
        >
          {{ \Illuminate\Support\Str::limit($archive->title, 40, '...') }}
        </td>

        <td
          class="whitespace-nowrap px-3 py-12 text-center text-sm font-medium tracking-wider text-slate-800"
        >
          {{ $archive->year }}
        </td>

        <td
          class="whitespace-nowrap px-3 text-center text-sm font-medium tracking-wider text-slate-800"
        >
          {{ $archive->research_agenda->agenda_name }}
        </td>

        <td
          class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800"
        >
          {{ $archive->department->dept_name }}
        </td>

        <td
          class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800"
        >
          {{ $archive->curriculum->curr_name }}
        </td>

        <td
          class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800"
        >
        @if($archive->archive_status == 1)
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-green-300 to-green-400 text-green-800">
          Published
         </span>
        @elseif ($archive->archive_status == 2)
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-red-300 to-red-400 text-red-800">
        Unpublished
        </span>
        @else
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gradient-to-r from-gray-300 to-gray-400 text-gray-800">
        Pending
        </span>
        @endif
        </td>
        <td
          class="whitespace-nowrap p-3 text-center text-sm font-medium tracking-wider text-slate-800"
        >
          <a wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed pointer-events-none" href="{{ route('view.archives', $archive->archive_code) }}" class="mr-2"> <i class="fa-solid fa-eye text-slate-900 hover:text-opacity-80 duration-150 fa-xl"></i> </a>
          @if($archive->archive_status != 1)
          <button wire:loading.attr="disabled" wire:loading.class="cursor-not-allowed" wire:click.prevent="deleteConfirmation({{ $archive->id }})" class="mx-2 cursor-pointer"> <i class="fa-solid text-red-500 hover:text-opacity-80 duration-150 fa-trash fa-xl"></i> </button>
          @endif
        </td>
      </tr>
      @empty
      <tr wire:loading.class="opacity-50" class="odd:bg-white even:bg-slate-50 focus:outline-none h-26 text-sm leading-none text-gray-800 bg-white border-b border-t border-gray-100"
          >
          <td colspan="8">
              <div class="flex items-center justify-center">
              <div>
                  <p class="text-lg sm:text-xl py-8 font-medium leading-none text-gray-400">No archives found...</p>
              </div>
              </div>
          </td>
          </tr>
      @endforelse
    </tbody>
  </table>
