<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="/favicon.svg" />
<link rel="shortcut icon" href="/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
<meta name="apple-mobile-web-app-title" content="Linkkilista.fi" />
<link rel="manifest" href="/site.webmanifest" />

@production
    @if(config('services.plausible.enabled'))
        <script defer data-api="{{ config('services.plausible.data.api') }}" data-domain="{{ config('services.plausible.data.domain') }}" data-spa="auto" src="{{ config('services.plausible.src') }}"></script>
    @endif
@endproduction

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
