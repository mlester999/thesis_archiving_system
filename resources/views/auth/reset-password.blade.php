<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{-- <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a> --}}
        </x-slot>

        @php
            if (count($errors) > 0) {
                $tokenError = collect($errors->default)->sortBy('key');
                $tokenKeys = $tokenError->keys();

                if(array_key_exists("email", $tokenError->toArray())) {
                    if($tokenError['email'][0] == "This password reset token is invalid.") {
                    RealRashid\SweetAlert\Facades\Alert::error("Reset Token Invalid", "Please go back to the login page and try to it reset again.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                    } else {
                        RealRashid\SweetAlert\Facades\Alert::error("Password Reset Failed", "Password does not match. Please try again.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                    }
                }  else if(array_key_exists("password", $tokenError->toArray())) {
                    if($tokenError['password'][0] == "The password must be at least 8 characters.") {
                    RealRashid\SweetAlert\Facades\Alert::error("Password Reset Failed", "The password must be at least 8 characters. Please try again.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                    } else {
                        RealRashid\SweetAlert\Facades\Alert::error("Password Reset Failed", "Password does not match. Please try again.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                    }
                }   else {
                    RealRashid\SweetAlert\Facades\Alert::error("Password Reset Failed", "Password does not match. Please try again.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                }
            }
            
        @endphp

        <div x-cloak x-data="{ buttonDisabled: false }" class="relative flex flex-col mx-12 space-y-10 bg-white shadow-2xl rounded-lg md:flex-row md:space-y-0 md:m-0">
            
            <div x-cloak x-transition.opacity x-show="buttonDisabled" class="loading absolute z-20">
                <span class="bar"></span>
            </div>

            <div x-cloak x-transition.opacity x-show="buttonDisabled" class="absolute bg-stone-600 bg-opacity-30 z-10 h-full w-full rounded-lg">
            </div>
            
            <form x-on:submit="buttonDisabled = true" method="POST" action="{{ route('logout') }}">
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

        <form x-on:submit="buttonDisabled = true" method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mt-6">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input readonly id="email" class="block mt-1 w-full focus:border-gray-300 bg-blue-50 focus:ring-0" type="email" name="email" :value="old('email', $request->email)" />
            </div>

            <!-- Password -->
            <div class="mt-6">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autofocus/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-primary-button x-bind:disabled="buttonDisabled" x-bind:class="buttonDisabled ? 'cursor-not-allowed' : 'cursor-pointer' " class="mt-4">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
    </x-auth-card>
</x-guest-layout>
