<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>
        <link rel="icon" href="/icon.ico">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased overflow-hidden">
        <div class=" bg-gradient-to-r from-green-300 to-blue-300">
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
                        <div class="col-span-2 m row-span-3 bg-white p-4 shadow-lg max-w-4xl ml-6 i " >
                           <div class="flex justify-center items-center">
                               <a href="/">
                                   <img src="/logo.png" alt="sad" class="h-[100px] w-[350px]">
                               </a>
                           </div>
                            <div class="text-center m-4 ">
                                <div class="avatar ">
                                    <div class="size-24 rounded-full">
                                        <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                    </div>

                                </div>
                            </div>
                            <div class="text-center m-6 border-b text-3xl">
                                <p> <?php $id = Auth::user()->name;;
                                    echo $id;?></p>
                            </div>
                            <div>
                                <div class="text-3xl text-center m-7">Status</div>
                                <div class="w-full max-w-xl mx-auto">
                                    <div class="w-full  rounded-full h-6 ">
                                        <div id="progress-bar" class="h-6 rounded-full " ></div>
                                    </div>
                                    <div  class="text-center text-xl mt-2" id="points">0 points</div>
                                </div>


                            </div>

                            <div id="status-text" class="text-4xl text-center m-7">

                            </div>

                            <div class="text-center">
                                <a {{$attributes}}> +</a>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // localStorage.setItem("points", 1000);
                        let points = parseInt(<?php $points = Auth::user()->points;;
                                              echo $points;?>);// Example points data
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
