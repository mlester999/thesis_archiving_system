<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{-- <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a> --}}
        </x-slot>

        <div class="relative max-w-xl flex flex-col m-6 space-y-10 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0 md:m-0">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="absolute left-6 top-5 text-lg"><i class="fa-solid fa-arrow-left fa-xl hover:text-slate-500 duration-200"></i></button>
            </form>
            <!-- Left Side -->
            <div class="p-6 md:p-16">
            <!-- Top Content -->
            <h2 class="font-sans mb-5 text-4xl font-bold mr-12">Verify Email Address</h2>

        <div class="mb-4 text-md text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div class="flex items-center justify-center mt-8">
                    <x-primary-button>
                        {{ __('Send Verification Email') }}
                    </x-primary-button>
                </div>
            </div>
            </form>
    </div>
    </x-auth-card>
</x-guest-layout>
