<?php
    use App\models\Role;
    $roles = Role::all();
?>

<x-guest-layout>
    <x-auth-card>
            <x-slot name="logo">
            </x-slot>
        <div class="flex items-center justify-center">
            <img src="images/soccaass_logo_black.png" alt="soccaass_logo" width="200" height="200">
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="role" :value="__('Role')" />
                <!--<x-input id="role" class="block mt-1 w-full" type="text" name="role" :value="old('role')" required />-->
                <select name="role" class="form-control custom-select">
                    <option value="">Select Role</option>
                    @foreach($roles as $role)
                    @if($role->name != 'admin')
                        <option value="{{ $role->name }}"

                        @if(old('role') == $role->id)
                            selected
                        @endif>{{ $role->name }}</option>

                    @endif
                    @endforeach
                </select>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>


            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="mt-4 ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
