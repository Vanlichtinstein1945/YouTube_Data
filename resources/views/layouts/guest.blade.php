<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom Styles -->
        <style>
            body {
                font-family: 'Figtree', sans-serif;
                background-color: #1a1a2e;
                color: #000000;
            }

            .guest-layout {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                padding: 20px;
            }

            .logo-container {
                display: flex;
                justify-content: center;
                width: 100%;
                max-width: 100px;
                margin-bottom: 20px;
            }

            .content-container {
                width: 100%;
                max-width: 400px;
                background-color: #ffffff;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 30px;
                position: relative;
                z-index: 2;
            }

            svg {
                width: 100%;
                height: auto;
            }

            .logo-container a{
                color: #ffffff;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }
        </style>
    </head>
    <body>
        <div class="guest-layout">
            <div class="logo-container">
                <a href="/">
                    <x-application-logo class="w-20 h-20 text-black" />
                </a>
            </div>

            <div class="content-container">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
