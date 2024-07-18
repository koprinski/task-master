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
<body class="font-sans antialiased">
<div class="bg-gradient-to-r from-green-300 to-blue-300 min-h-screen">
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
    <main class="text-black">
        <div class="p-1 bg-green-400">
            <div class="navbar grid grid-cols-1 sm:grid-cols-3 gap-4 text-center" >
                <a class="btn btn-ghost text-3xl" href="{{route('Habbits')}}">Habits</a>
                <a class="btn btn-ghost text-3xl" href="{{route('DailyTasks')}}">Daily tasks</a>
                <a class="btn btn-ghost text-3xl" href="{{route('LongTermTasks')}}">Long-term </a>
            </div>
        </div>
        <div class="mt-6 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-6 gap-4 px-4">
                <!-- Wide Column -->
                <div class="relative col-span-1 lg:col-span-4 bg-white p-4 shadow-lg max-h-[700px] overflow-scroll">
                    <h2 class="text-4xl font-bold mb-4">@yield('header')</h2>

                    {{-- The block needs to appear here --}}
                    <div id="@yield('container')">
                        <!-- Dynamic habit blocks will be inserted here -->
                    </div>

                    <p class="text-2xl mt-10">@yield('content')</p>
                </div>
                {{$slot}}
                <!-- Narrow Column -->
                <div class="col-span-1 lg:col-span-2 bg-white p-4 shadow-lg">
                    <div class="flex justify-center items-center">
                        <a href="/">
                            <img src="/logo.png" alt="logo" class="h-24 w-auto">
                        </a>
                    </div>
                    <div class="text-center mt-4">
                        <div class="avatar relative w-24 h-24 mx-auto">
                            <!-- Link wrapper to make the entire avatar clickable -->
                            <a href="#" class="block w-full h-full relative group" id="avatar-link">
                                <!-- Avatar image -->
                                <img
                                    class="w-full h-full object-cover rounded-full transition duration-300 ease-in-out group-hover:filter group-hover:grayscale-[80%]"
                                    src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg"
                                    alt="Avatar"
                                    id="avatar-img"
                                />
                                <!-- Upload icon -->
                                <img
                                    class="max-h-12 max-w-12 absolute bottom-7 right-6 hidden group-hover:block"
                                    src="https://www.svgrepo.com/show/33565/upload.svg"
                                    alt="Upload Icon"
                                />
                            </a>
                            <!-- Hidden file input -->
                            <input type="file" id="avatar-input" class="hidden" accept="image/*">
                        </div>
                    </div>
                    <div class="text-center mt-6 border-b text-3xl">
                        <a href="{{route('insertUserName')}}"> Username </a>
                    </div>
                    <div class="mt-6">
                        <div class="text-3xl text-center mb-4">Status</div>
                        <div class="w-full max-w-xl mx-auto">
                            <div class="w-full bg-gray-200 rounded-full h-6">
                                <div id="progress-bar" class="h-6 rounded-full"></div>
                            </div>
                            <div class="text-center text-xl mt-2" id="points">0 points</div>
                        </div>
                    </div>
                    <div id="status-text" class="text-4xl text-center mt-6">
                    </div>
                    <div class="text-center mt-6">
                        <a {{$attributes}} class="text-3xl"> +</a>
                    </div>
                </div>
            </div>
        </div>
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

                // Avatar click event
                const avatarLink = document.getElementById('avatar-link');
                const avatarInput = document.getElementById('avatar-input');
                const avatarImg = document.getElementById('avatar-img');

                avatarLink.addEventListener('click', function (e) {
                    e.preventDefault();
                    avatarInput.click();
                });

                avatarInput.addEventListener('change', function () {
                    const file = avatarInput.files[0];
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        avatarImg.src = e.target.result;
                    }

                    if (file) {
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
    </main>
</div>
</body>
</html>
