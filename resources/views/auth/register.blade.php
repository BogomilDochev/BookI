<x-layout>
    <div class="font-sans text-gray-900 antialiased">
        <x-auth-card>
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                {{-- Avatar --}}
                <div class="mt-4">
                    <x-input-label for="avatar" :value="__('Choose an avatar')" />
                    <div class="grid grid-cols-6">
                        <input type="radio" id="avatar1" name="avatar" value="avatar1.png" class="mt-6" checked>
                        <img src="/images/avatars/avatar1.png" alt="" width="60" height="60" class="rounded-xl -ml-10" >

                        <input type="radio" id="avatar3" name="avatar" value="avatar3.png" class="mt-6">
                        <img src="/images/avatars/avatar3.png" alt="" width="60" height="60" class="rounded-xl -ml-10" >

                        <input type="radio" id="avatar5" name="avatar" value="avatar5.png" class="mt-6">
                        <img src="/images/avatars/avatar5.png" alt="" width="60" height="60" class="rounded-xl -ml-10" >

                        <input type="radio" id="avatar4" name="avatar" value="avatar4.png" class="mt-6">
                        <img src="/images/avatars/avatar4.png" alt="" width="60" height="60" class="rounded-xl -ml-10" >

                        <input type="radio" id="avatar2" name="avatar" value="avatar2.png" class="mt-6">
                        <img src="/images/avatars/avatar2.png" alt="" width="60" height="60" class="rounded-xl -ml-10" >

                        <input type="radio" id="avatar7" name="avatar" value="avatar7.png" class="mt-6">
                        <img src="/images/avatars/avatar7.png" alt="" width="60" height="60" class="rounded-xl -ml-10" >

                        <input type="radio" id="avatar8" name="avatar" value="avatar8.png" class="mt-6">
                        <img src="/images/avatars/avatar8.png" alt="" width="60" height="60" class="rounded-xl -ml-10" >

                        <input type="radio" id="avatar6" name="avatar" value="avatar6.png" class="mt-6">
                        <img src="/images/avatars/avatar6.png" alt="" width="60" height="60" class="rounded-xl -ml-10" >
                    </div>
                    <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ml-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </x-auth-card>
    </div>
    <x-footer />
</x-layout>
