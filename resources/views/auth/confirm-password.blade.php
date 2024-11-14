<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mb-4 text-xl font-semibold leading-tight text-gray-800">{{ __('Confirm Password') }}</h2>

                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </div>

                    <form
                        method="POST"
                        action="{{ route('password.confirm') }}"
                    >
                        @csrf

                        <!-- Password -->
                        <div>
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
                                autocomplete="current-password"
                                placeholder="supersecretpassword"
                            />
                            <x-input-error
                                class="mt-2"
                                :messages="$errors->get('password')"
                            />
                        </div>

                        <div class="flex justify-end mt-4">
                            <x-v-button type="submit">
                                {{ __('Confirm') }}
                            </x-v-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
