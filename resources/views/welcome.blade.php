<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel 11 Backend</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

         @vite('resources/css/app.css')
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50 min-h-screen flex justify-center items-center">
        <div class="text-pretty">
            <p class="text-4xl">Laravel 11 as backend website</p>
            <h2>Please follow these documentation link:</h2>
            <a href="/" class="underline decoration-sky-500">documentation link</a>
        </div>
    </body>
</html>
