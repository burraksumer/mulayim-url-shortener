<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4 text-xl font-semibold leading-tight text-gray-800">{{ __('Register') }}</h2>

                    <form
                        method="POST"
                        action="{{ route('register') }}"
                    >
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label
                                for="name"
                                :value="__('Name')"
                            />
                            <x-text-input
                                class="block w-full mt-1"
                                id="name"
                                name="name"
                                type="text"
                                :value="old('name')"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="John Doe"
                            />
                            <x-input-error
                                class="mt-2"
                                :messages="$errors->get('name')"
                            />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label
                                for="email"
                                :value="__('Email')"
                            />
                            <x-text-input
                                class="block w-full mt-1"
                                id="email"
                                name="email"
                                type="email"
                                :value="old('email')"
                                required
                                autocomplete="username"
                                placeholder="john@doe.com"
                            />
                            <x-input-error
                                class="mt-2"
                                :messages="$errors->get('email')"
                            />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label
                                for="password"
                                :value="__('Password')"
                            />
                            <x-text-input
                                class="block w-full mt-1"
                                id="password"
                                name="password"
                                type="password"
                                required
                                autocomplete="new-password"
                                placeholder="supersecretpassword"
                            />
                            <x-input-error
                                class="mt-2"
                                :messages="$errors->get('password')"
                            />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label
                                for="password_confirmation"
                                :value="__('Confirm Password')"
                            />
                            <x-text-input
                                class="block w-full mt-1"
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                required
                                autocomplete="new-password"
                                placeholder="supersecretpassword"
                            />
                            <x-input-error
                                class="mt-2"
                                :messages="$errors->get('password_confirmation')"
                            />
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <x-link
                                className="text-sm text-gray-600 underline"
                                href="login"
                            >
                                {{ __('Already registered?') }}
                            </x-link>

                            <x-v-button
                                class="w-2/4 ms-4"
                                type="submit"
                            >
                                {{ __('Register') }}
                            </x-v-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
