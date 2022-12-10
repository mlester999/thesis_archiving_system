<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{-- <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a> --}}
        </x-slot>

        @php
            if (count($errors) > 0) {
                $forgotPassError = collect($errors->default)->sortBy('key');
                $forgotPassKeys = $forgotPassError->keys();

                if(array_key_exists("email", $forgotPassError->toArray())) {
                    if($forgotPassError['email'][0] == "Please wait before retrying.") {
                        RealRashid\SweetAlert\Facades\Alert::error("Something Went Wrong", "Please wait before trying.")->showConfirmButton('OK', '#2678c5')->width('420px')->autoClose(5000);
                    } else {
                        RealRashid\SweetAlert\Facades\Alert::error("Reset Failed", "We can't find a user with that email address.")->showConfirmButton('OK', '#2678c5')->width('420px')->autoClose(5000);
                    }
                } else {
                    RealRashid\SweetAlert\Facades\Alert::error("Reset Failed", "We can't find a user with that email address.")->showConfirmButton('OK', '#2678c5')->width('420px')->autoClose(5000);
                }
            }
        @endphp

        <div x-cloak x-data="{ buttonDisabled: false }" class="max-w-2xl relative flex flex-col mx-12 space-y-10 bg-white shadow-2xl rounded-lg md:flex-row md:space-y-0 md:m-0">
            
            <div x-cloak x-transition.opacity x-show="buttonDisabled" class="loading absolute z-20">
                <span class="bar"></span>
            </div>

            <div x-cloak x-transition.opacity x-show="buttonDisabled" class="absolute bg-stone-600 bg-opacity-30 z-10 h-full w-full rounded-lg">
            </div>
            
            <a @click="buttonDisabled = true" href="/" class="absolute left-6 top-4 text-lg"><i class="fa-solid fa-arrow-left fa-lg md:fa-xl hover:text-slate-500 duration-200"></i></a>
            <!-- Left Side -->
            <div class="px-12 pt-6 pb-8 md:p-16">
            <!-- Top Content -->
            <h2 class="font-sans mb-4 sm:mb-5 text-2xl sm:text-3xl font-bold">Forgot Password</h2>

        <div class="mb-4 text-sm sm:text-base text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form x-on:submit="buttonDisabled = true" method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autofocus />
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-primary-button x-bind:disabled="buttonDisabled" x-bind:class="buttonDisabled ? 'cursor-not-allowed' : 'cursor-pointer' " class="mt-4">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
    </x-auth-card>
</x-guest-layout>
