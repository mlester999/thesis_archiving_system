@extends('master')
@section('user')

<div class="rounded-lg max-w-md sm:max-w-xl md:max-w-2xl lg:max-w-4xl xl:max-w-7xl mx-auto my-8 relative">
  <form action="{{ url('department', strtolower($currentPage)) }}" method="get">   
    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
    <div class="flex justify-between">
      <div>
        <h1 class="inline-block text-2xl md:text-3xl font-bold mb-8">My Archives </h1> 
      </div>
    </div>
</form>
    <div class="border-t border-gray-200 shadow-xl rounded-lg">
        <div class="mb-10">
            <div class="flex flex-col">
              <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                  <div class="overflow-hidden md:rounded-lg">
                      @livewire('delete-record')
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
      class="flex flex-col xs:flex-row xs:justify-between px-32 pb-8"
      >	
      {{ $archives->links() }}
      </div>

      <script>
        window.addEventListener('show-delete-confirmation', event => {
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
          }).then((result) => {
            if (result.isConfirmed) {
              Livewire.emit('deleteConfirmed')
            }
          })
        });

        window.addEventListener('archiveDeleted', event => {
          Swal.fire({
            title: 'Deleted!',
            text: 'The archive has been deleted.',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            timer: 5000
          })
      });

      </script>

      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection