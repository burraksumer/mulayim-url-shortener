<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-v-button
        class="md:w-1/2"
        variant="danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-v-button>

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >
        <form
            class="p-6"
            method="post"
            action="{{ route('profile.destroy') }}"
        >
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label
                    class="sr-only"
                    for="password"
                    value="{{ __('Password') }}"
                />
                <x-text-input
                    class="w-full"
                    id="password"
                    name="password"
                    type="password"
                    placeholder="{{ __('Password') }}"
                />
                <x-input-error
                    class="mt-2"
                    :messages="$errors->userDeletion->get('password')"
                />
            </div>

            <div class="flex justify-center gap-2 mt-6">
                <x-v-button
                    class="md:w-1/2"
                    type="button"
                    variant="white"
                    x-on:click="$dispatch('close')"
                >
                    {{ __('Cancel') }}
                </x-v-button>
                <x-v-button
                    class="md:w-1/2"
                    type="submit"
                    variant="danger"
                >
                    {{ __('Delete Account') }}
                </x-v-button>
            </div>
        </form>
    </x-modal>
</section>
