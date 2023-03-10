<x-guest-layout>
    <!--<x-auth-card>-->
        <!--<x-slot name="logo">
        </x-slot>-->
        <!--<a href="/">
        </a>-->
            <!--<x-application-logo class="w-20 h-20 fill-current text-gray-500" />-->
    <style>
        @media (max-width: 1100px) {
            .hidden-middle {
                display: none;
            }
        }
    </style>

    <div >
        <img class="hidden-middle" style="float: left" src="images/login_sideBG2.png">
        <x-auth-card>
            <x-slot name="logo">
            </x-slot>
            <div class="flex items-center justify-center">
                <img src="images/soccaass_logo_black.png" alt="soccaass_logo" width="200" height="200">
            </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="pt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class=" text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('register') }}"
                   class=" text-sm text-gray-600 hover:text-gray-900 @if(Route::currentRouteName() === 'register') current-page @endif" >
                    {{ __('Register?') }}
                </a>
            </div>
            <div class="flex items-center justify-center pt-4">
                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
        </x-auth-card>
    </div>
    <!--</x-auth-card> -->
</x-guest-layout>
