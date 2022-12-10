<x-admin-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{-- <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a> --}}
        </x-slot>

        <div x-cloak x-data="{ buttonDisabled: false }"  class="relative max-w-xl flex flex-col mx-12 space-y-10 bg-white shadow-2xl rounded-lg md:flex-row md:space-y-0 md:m-0">
            
            <div x-cloak x-transition.opacity x-show="buttonDisabled" class="loading absolute z-20">
                <span class="bar"></span>
            </div>

            <div x-cloak x-transition.opacity x-show="buttonDisabled" class="absolute bg-stone-600 bg-opacity-30 z-10 h-full w-full rounded-lg">
            </div>
            
            <form x-on:submit="buttonDisabled = true" method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="absolute left-6 top-4 text-lg"><i class="fa-solid fa-arrow-left fa-lg md:fa-xl hover:text-slate-500 duration-200"></i></button>
            </form>
            <!-- Left Side -->
            <div class="px-8 pt-6 pb-8 md:p-16">
            <!-- Top Content -->
            <h2 class="font-sans mb-4 sm:mb-5 text-2xl sm:text-3xl font-bold md:mr-12">Verify Email Address</h2>

        <div class="mb-4 text-md text-sm sm:text-base text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'admin.verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

            <form x-on:submit="buttonDisabled = true" method="POST" action="{{ route('admin.verification.send') }}">
                @csrf
                <div class="flex items-center justify-center mt-8">
                    <x-primary-button x-bind:disabled="buttonDisabled" x-bind:class="buttonDisabled ? 'cursor-not-allowed' : 'cursor-pointer' ">
                        {{ __('Send Verification Email') }}
                    </x-primary-button>
                </div>
            </div>
            </form>
    </div>
    </x-auth-card>
</x-admin-guest-layout>
