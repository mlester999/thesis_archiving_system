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
                        RealRashid\SweetAlert\Facades\Alert::error("Something Went Wrong", "Please wait before trying.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                    } else {
                        RealRashid\SweetAlert\Facades\Alert::error("Reset Failed", "We can't find a user with that email address.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                    }
                } else {
                    RealRashid\SweetAlert\Facades\Alert::error("Reset Failed", "We can't find a user with that email address.")->showConfirmButton('OK', '#2678c5')->autoClose(5000);
                }

            }
        @endphp

        <div class="max-w-2xl relative flex flex-col m-6 space-y-10 bg-white shadow-2xl rounded-2xl md:flex-row md:space-y-0 md:m-0">
            <a href="/" class="absolute left-6 top-5 text-lg"><i class="fa-solid fa-arrow-left fa-xl hover:text-slate-500 duration-200"></i></a>
            <!-- Left Side -->
            <div class="p-6 md:p-16">
            <!-- Top Content -->
            <h2 class="font-sans mb-5 text-4xl font-bold">Forgot Password</h2>

        <div class="mb-4 text-md text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autofocus />
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-primary-button class="mt-4">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
    </x-auth-card>
</x-guest-layout>
