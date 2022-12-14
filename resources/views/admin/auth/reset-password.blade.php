<x-admin-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{-- <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a> --}}
        </x-slot>

        @php
            if (count($errors) > 0) {
                RealRashid\SweetAlert\Facades\Alert::error("Reset Failed", "Password do not match. Please try again.")->showConfirmButton('Okay', '#2678c5')->autoClose(6000);
            }
        @endphp

        <div class="relative flex flex-col m-6 space-y-10 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0 md:m-0">
            <a href="/" class="absolute left-6 top-5 text-lg"><i class="fa-solid fa-arrow-left fa-xl hover:text-slate-500 duration-200"></i></a>
            <!-- Left Side -->
            <div class="p-6 md:p-16">
            <!-- Top Content -->
            <h2 class="font-sans mb-5 text-4xl font-bold mr-48">Reset Password</h2>

        <form method="POST" action="{{ route('admin.password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" autofocus />

                {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />

                {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />

                {{-- <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> --}}
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </div>
        </form>
    </div>
    </x-auth-card>
</x-admin-guest-layout>
