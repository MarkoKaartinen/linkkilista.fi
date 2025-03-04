<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-dvh flex flex-col bg-white from-zinc-300 to-zinc-100 dark:bg-zinc-800 bg-linear-to-b dark:from-zinc-900 dark:to-zinc-800">

<div class="grow py-6">
    {{ $slot }}
</div>

<div class="mt-auto text-center px-4 pb-2 pt-6">
    <flux:button size="xs" variant="primary" href="{{ route('home') }}" icon-trailing="arrow-top-right-on-square">
        Luo oma linkkilistasi
    </flux:button>
</div>

@fluxScripts
</body>
</html>
