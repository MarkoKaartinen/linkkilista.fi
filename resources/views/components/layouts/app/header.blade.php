<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white from-zinc-300 to-zinc-100 dark:bg-zinc-800 bg-linear-to-b dark:from-zinc-900 dark:to-zinc-800">
        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-800">
            <a href="{{ route('home') }}" class="mr-5 flex items-center space-x-2 lg:ml-0" wire:navigate>
                <x-app-logo class="size-8" href="{{ route('home') }}"></x-app-logo>
            </a>

            <flux:spacer />

            @guest
                <flux:navbar class="space-x-0.5 py-0!">
                    <div class="hidden sm:block">
                        <flux:button size="sm" href="{{ route('login') }}">
                            {{ __('Kirjaudu') }}
                        </flux:button>
                        <flux:button size="sm" variant="primary" href="{{ route('register') }}">
                            {{ __('Luo tunnus') }}
                        </flux:button>
                    </div>

                    <flux:dropdown x-data align="end">
                        <flux:button variant="subtle" size="sm" square class="group" aria-label="Preferred color scheme">
                            <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini" class="text-zinc-500 dark:text-white" />
                            <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini" class="text-zinc-500 dark:text-white" />
                            <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />
                            <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />
                        </flux:button>

                        <flux:menu>
                            <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">{{ __('Vaalea') }}</flux:menu.item>
                            <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">{{ __('Tumma') }}</flux:menu.item>
                            <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">{{ __('Järjestelmä') }}</flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>

                    <flux:dropdown position="top" align="end" class="sm:hidden">
                        <flux:button variant="subtle" icon-trailing="bars-3" size="sm" />

                        <flux:menu class="space-y-1">
                            <flux:button class="w-full" size="sm" variant="filled" href="{{ route('login') }}">
                                {{ __('Kirjaudu') }}
                            </flux:button>
                            <flux:button class="w-full" size="sm" variant="primary" href="{{ route('register') }}">
                                {{ __('Luo tunnus') }}
                            </flux:button>
                        </flux:menu>
                    </flux:dropdown>
                </flux:navbar>
            @endguest

            <!-- Desktop User Menu -->
            @auth
                <flux:dropdown x-data align="end" class="mr-2">
                    <flux:button variant="subtle" size="sm" square class="group" aria-label="Preferred color scheme">
                        <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini" class="text-zinc-500 dark:text-white" />
                        <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini" class="text-zinc-500 dark:text-white" />
                        <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />
                        <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />
                    </flux:button>

                    <flux:menu>
                        <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">{{ __('Vaalea') }}</flux:menu.item>
                        <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">{{ __('Tumma') }}</flux:menu.item>
                        <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">{{ __('Järjestelmä') }}</flux:menu.item>
                    </flux:menu>
                </flux:dropdown>

                <flux:dropdown position="top" align="end">
                    <flux:profile
                        class="cursor-pointer"
                        :initials="auth()->user()->initials()"
                        :avatar="auth()->user()->hasMedia('avatar') ? auth()->user()->getFirstMedia('avatar')->getAvailableFullUrl(['small']) : null"
                    />

                    <flux:menu>
                        <flux:menu.radio.group>
                            <div class="p-0 text-sm font-normal">
                                <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                    <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                        @if(auth()->user()->hasMedia('avatar'))
                                            <img class="h-full w-full items-center justify-center rounded-lg" src="{{ auth()->user()->getFirstMedia('avatar')->getAvailableFullUrl(['small']) }}" alt="{{ auth()->user()->name }} avatar" />
                                        @else
                                            <span
                                                class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                            >
                                                {{ auth()->user()->initials() }}
                                            </span>
                                        @endif
                                    </span>

                                    <div class="grid flex-1 text-left text-sm leading-tight">
                                        <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                        <span class="truncate text-xs">{{ "@".auth()->user()->username }}</span>
                                    </div>
                                </div>
                            </div>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <flux:menu.radio.group>
                            <flux:menu.item href="{{ route('user.profile', [auth()->user()->username]) }}" icon="user" wire:navigate>{{ __('Oma linkkilista') }}</flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <flux:menu.radio.group>
                            <flux:menu.item href="{{ route('dashboard') }}" icon="link" wire:navigate>{{ __('Linkit') }}</flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <flux:menu.radio.group>
                            <flux:menu.item href="{{ route('settings.profile') }}" icon="cog" wire:navigate>{{ __('Asetukset') }}</flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                                {{ __('Kirjaudu ulos') }}
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            @endauth
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
