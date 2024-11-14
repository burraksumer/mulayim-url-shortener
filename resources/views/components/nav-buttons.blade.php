<div class="flex flex-col space-y-4 bg-inherit">

    <x-link-button
        href='welcome'
        variant="{{ Route::is('welcome') ? 'dark' : 'white' }}"
    >Home</x-link-button>
    <x-link-button
        href='about'
        variant="{{ Route::is('about') ? 'dark' : 'white' }}"
    >About</x-link-button>

    @auth
        <x-link-button
            href="{{ route('dashboard') }}"
            variant="{{ Str::contains(Route::currentRouteName(), 'dashboard') || Route::is('verification.notice') ? 'dark' : 'white' }}"
        >Dashboard</x-link-button>

        <x-link-button
            href="{{ route('profile.edit') }}"
            variant="{{ Route::is('profile.edit') ? 'dark' : 'white' }}"
        >Profile</x-link-button>
    @endauth

    {{-- Show logout or login based on if the user is logged in or not --}}
    @auth
        <form
            id="logout-form"
            action="{{ route('logout') }}"
            method="POST"
        >
            @csrf
            <x-v-button
                href='#'
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                variant="{{ Route::is('logout') ? 'dark' : 'white' }}"
            >Logout</x-v-button>
        </form>
    @else
        <x-link-button
            href='register'
            variant="{{ Route::is('login', 'register', 'password.request') ? 'dark' : 'white' }}"
        >Register</x-link-button>
    @endauth

    <hr>

    <small class="px-4 py-2 text-xs font-medium leading-none text-muted-foreground">Mulayim</small>

    <x-link-button
        external='https://github.com/burraksumer'
        target='_blank'
        variant='white'
        iconName='github'
        iconNameEnd='arrow-up-right'
    >
        Discord
    </x-link-button>

</div>
