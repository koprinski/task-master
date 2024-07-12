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

    </head>
    <body class="font-sans antialiased ">
        <div class="min-h-screen max-h-[100px] bg-gradient-to-r from-green-300 to-blue-300">
{{--            @include('layouts.navigation')--}}

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="">
                <div class="p-1 bg-green-400">
                    <div class="navbar grid grid-cols-3  " >
                        <a class="btn btn-ghost col-span-1 text-3xl" href="{{route('Habbits')}}">Habits</a>
                        <a class="btn btn-ghost col-span-1 text-3xl" href="{{route('DailyTasks')}}">Daily tasks</a>
                        <a class="btn btn-ghost col-span-1 text-3xl" href="{{route('LongTermTasks')}}">Long-term tasks</a>
                    </div>
                </div>
                <div class=" mt-6 w-full ">
                    <div class="grid grid-cols-6 grid-rows-6 gap-4 m-24">
                        <!-- Wide Column -->
                        {{$slot}}
                        <!-- Narrow Column -->

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // localStorage.setItem("points", 1000);
                        let points = parseInt(localStorage.getItem("points"));// Example points data
                        const progressBar = document.getElementById('progress-bar');
                        const statusText = document.getElementById('status-text');

                        // Update progress bar color based on points
                        if (points >= 700) {
                            progressBar.classList.add('bg-green-400');
                            statusText.textContent = 'You are doing great!';
                        } else if (points >= 300) {
                            progressBar.classList.add('bg-orange-400');
                            statusText.textContent = 'You are doing OK!';
                        } else {
                            progressBar.classList.add('bg-red-600');
                            statusText.textContent = 'You are doing horrible!';
                        }

                        // Update points text
                        document.getElementById('points').textContent = points + ' points';
                    });
                </script>
            </main>
        </div>
    </body>
</html>
