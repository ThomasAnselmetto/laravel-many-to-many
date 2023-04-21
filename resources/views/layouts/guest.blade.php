<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Projects') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/js/front.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased ">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <h1>Post Recenti</h1>
                    @section('content')
                </div>
            </div>
        </div>
    </body>
    </html>

