<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                @auth
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        @if (auth()->user()->isAdmin())
                            <x-nav-link :href="route('profily.index')" :active="request()->routeIs('profily.index')">
                                {{ __('Všechny účty') }}
                            </x-nav-link>
                            <x-nav-link :href="route('kocky.index')" :active="request()->routeIs('kocky.index')">
                                {{ __('Všechny kočky') }}
                            </x-nav-link>
                            <x-nav-link :href="route('hlidani.index')" :active="request()->routeIs('hlidani.index')">
                                {{ __('Všechna hlídání') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('index')" :active="request()->routeIs('index')">
                                {{ __('Sháním hlídání') }}
                            </x-nav-link>
                            <x-nav-link :href="route('kocky.index')" :active="request()->routeIs('kocky.index')">
                                {{ __('Moje kočky') }}
                            </x-nav-link>
                            <x-nav-link :href="route('hlidani.index')" :active="request()->routeIs('hlidani.index')">
                                {{ __('Moje hlídání') }}
                            </x-nav-link>
                            @if (auth()->user()->isSitter())
                                <x-nav-link :href="route('dostupnost.index')" :active="request()->routeIs('dostupnost.index')">
                                    {{ __('Moje dostupnost') }}
                                </x-nav-link>
                            @endif
                        @endif
                    </div>
                @endauth
            </div>

            @auth
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot:trigger>
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ auth()->user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot:content>
                            <x-dropdown-link :href="route('profil.edit')">
                                {{ __('Nastavení účtu') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Odhlásit se') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <div class="hidden space-x-8 sm:-my-px sm:flex">
                    <x-nav-link :href="route('register')">
                        {{ __('Vytvořit nový účet') }}
                    </x-nav-link>
                    <x-nav-link :href="route('login')">
                        {{ __('Přihlásit se') }}
                    </x-nav-link>
                </div>
            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @auth
            @if (auth()->user()->isAdmin())
                <div class="py-2 space-y-1">
                    <x-responsive-nav-link :href="route('profily.index')" :active="request()->routeIs('profily.index')">
                        {{ __('Všechny účty') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('kocky.index')" :active="request()->routeIs('kocky.index')">
                        {{ __('Všechny kočky') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('hlidani.index')" :active="request()->routeIs('hlidani.index')">
                        {{ __('Všechna hlídání') }}
                    </x-responsive-nav-link>
                </div>
            @else
                <div class="py-2 space-y-1">
                    <x-responsive-nav-link :href="route('index')" :active="request()->routeIs('index')">
                        {{ __('Sháním hlídání') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('kocky.index')" :active="request()->routeIs('kocky.index')">
                        {{ __('Moje kočky') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('hlidani.index')" :active="request()->routeIs('hlidani.index')">
                        {{ __('Moje hlídání') }}
                    </x-responsive-nav-link>
                    @if (auth()->user()->isSitter())
                        <x-responsive-nav-link :href="route('dostupnost.index')" :active="request()->routeIs('dostupnost.index')">
                            {{ __('Moje dostupnost') }}
                        </x-responsive-nav-link>
                    @endif
                </div>
            @endif
            
            <!-- Responsive Settings Options -->
            <div class="pt-2 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ auth()->user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profil.edit')" :active="request()->routeIs('profil.edit')">
                        {{ __('Nastavení účtu') }}
                    </x-responsive-nav-link>
                    
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        
                        <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Odhlásit se') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Přihlásit se') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">
                    {{ __('Vytvořit nový účet') }}
                </x-responsive-nav-link>
            </div>
        @endauth
    </div>
</nav>
