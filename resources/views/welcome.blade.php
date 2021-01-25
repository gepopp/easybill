<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'mybilling') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

@livewireStyles
@stack('styles')
<!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-L0B9H1V39T"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-L0B9H1V39T');
    </script>
</head>
<body class="antialiased">
<div class="relative flex flex-col items-top justify-center min-h-screen bg-logo-gray dark:bg-gray-900 sm:items-center sm:pt-0">
    @env('local')
        <div class="absolute top-0 right-0 text-2xl">
            <a href="{{ route('login') }}">login</a>
        </div>
    @endenv
    <div class="flex flex-col items-center justify-center w-full">
        <x-jet-application-logo class="block h-48 w-auto"/>
        <h1 class="text-2xl font-bold text-logo-primary">mybilling.at</h1>
        <h3 class="leading-none text-sm">Dein kosnteloses Rechnungstool</h3>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-20 max-w-6xl mx-auto">
        <div class="">
            <div class="flex flex-col items-center justify-center pt-8">
                <h1 class="text-3xl font-bold text-logo-primary mb-5">We are Alpha</h1>
                <h3 class="text-center">Dein kosnteloses Rechnungstool befindet sich aktuell in der Entwicklung von der Aplha zur Beta Version. Melde dich zu unserem Newsletter an und wir infomieren dich sobald die Registrierung möglich ist.</h3>
                <p class="text-center pt-5">Auch suchen wir noch Betatester die uns dann als firendly User Feedback geben was noch fehlt und was wir noch besser machen können. Alle Anmelder die wir als Betatester auswählen erhalten einen
                    <span class="text-logo-secondary">kostenlosen Lifetime Zugang</span> zu allen Features unserer Plattform.
                </p>
            </div>
        </div>

        <div class="flex flex-col items-center justify-center pt-8">
            <h1 class="text-3xl font-bold text-logo-primary mb-5">Sei von Anfang an dabei!</h1>
            <p class="mb-5">Es geht zügig voran. Wir entwickeln diese Palttform mit Hochdruck. Hier kannst du dich zu unserem Newsletter anmelden und bekommst dann regelmäßig Updates über den Stand der Dinge von uns.</p>

            <livewire:newsletter-form/>
        </div>
    </div>
</div>
@stack('modals')
@livewireScripts
@stack('scripts'))
</body>
</html>
