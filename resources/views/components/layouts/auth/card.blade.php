<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white from-zinc-300 to-zinc-100 dark:bg-zinc-800 bg-linear-to-b dark:from-zinc-900 dark:to-zinc-800">
        <div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-md flex-col gap-6">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <div class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
                        <x-app-logo-icon class="size-5 text-white dark:text-black" />
                    </div>
                    <div class="ml-1 grid flex-1 text-left text-2xl">
                        <span class="mb-0.5 truncate leading-none font-semibold">{{ config('app.name') }}</span>
                    </div>
                </a>

                <div class="flex flex-col gap-6">
                    <div class="rounded-xl border bg-white dark:bg-stone-950 dark:border-stone-800 text-stone-800 shadow-xs">
                        <div class="px-10 py-8">{{ $slot }}</div>
                    </div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
