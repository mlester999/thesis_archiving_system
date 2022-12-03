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

        <div class="relative flex flex-col mx-12 space-y-10 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0 md:m-0">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="absolute left-6 top-4 text-lg"><i class="fa-solid fa-arrow-left fa-lg md:fa-xl hover:text-slate-500 duration-200"></i></button>
            </form>
            <!-- Left Side -->
            <div class="px-12 pt-6 pb-8 md:p-16">
            <!-- Top Content -->
            <h2 class="font-sans text-2xl sm:text-3xl font-bold md:mr-48">Reset Password</h2>
            <p class="mb-4 text-sm sm:text-base text-gray-600">
                Please make sure your passwords match.
            </p>

        <form x-data="{ buttonDisabled: false }" x-on:submit="buttonDisabled = true" method="POST" action="{{ route('admin.password.update') }}">
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
                <x-primary-button x-bind:disabled="buttonDisabled" x-bind:class="buttonDisabled ? 'cursor-not-allowed' : 'cursor-pointer' " class="mt-4">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </div>
        </form>
    </div>
    </x-auth-card>
</x-admin-guest-layout>
