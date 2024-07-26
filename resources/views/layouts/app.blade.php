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
{{--    @yield('scripts')--}}
</head>
<body class="font-sans antialiased">
@php($points = \Illuminate\Support\Facades\Auth::user()->points)
@php($img = \Illuminate\Support\Facades\Auth::user()->image )
@php($name = \Illuminate\Support\Facades\Auth::user()->name)

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
                <a class="btn btn-ghost text-3xl" href="{{route('daily')}}">Daily tasks</a>
                <a class="btn btn-ghost text-3xl" href="{{route('habits')}}">Habits</a>
                <a class="btn btn-ghost text-3xl" href="{{route('longTerm')}}">Long-term </a>
            </div>
        </div>
        <div class="mt-6 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-6 gap-4 px-4">
                <!-- Wide Column -->
                <div class="relative col-span-1 lg:col-span-4 bg-white p-4 shadow-lg max-h-[700px] overflow-scroll">
                    <h2 class="text-4xl font-bold mb-4">@yield('header')</h2>

                    {{-- The block needs to appear here --}}
                    <div id="@yield('container')">
                        {{$slot}}
                    </div>

                    <p class="text-2xl mt-10">@yield('content')</p>
                </div>

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
                            <a href="{{route('profile.update')}}" class="block w-full h-full relative group" id="avatar-link">
                                <!-- Avatar image -->
                                <img
                                    class="w-full h-full object-cover rounded-full transition duration-300 ease-in-out group-hover:filter group-hover:grayscale-[100%]"
                                    src="{{Storage::url('avatars/'.$img)}}"
                                    alt="Avatar"
                                    id="avatar-img"
                                />
                                <!-- Upload icon -->
                                <img
                                    class="max-h-12 max-w-12 absolute bottom-7 right-6 hidden group-hover:block "
                                    src="https://www.svgrepo.com/show/33565/upload.svg"
                                    alt="Upload Icon"
                                />
{{--                                <input type="image" src="https://www.svgrepo.com/show/33565/upload.svg"  class="max-h-12 max-w-12 absolute bottom-7 right-6 hidden group-hover:block" >--}}
                            </a>
                            <!-- Hidden file input -->
                            <input type="file" id="avatar-input" class="hidden" accept="image/*">
                        </div>
                    </div>
                    <div class="text-center mt-6 border-b text-3xl">
                        <a href="{{route('profile.update')}}"> {{$name}} </a>
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
                //progress bar
                function pBar(points)
                {
                    const progressBar = document.getElementById('progress-bar');
                    const statusText = document.getElementById('status-text');
                    progressBar.classList.remove('bg-red-600', 'bg-orange-400', 'bg-green-400');
                    if (points >= 700) {
                        // progressBar.classList.remove('bg-orange-400 bg-red-600');
                        progressBar.classList.add('bg-green-400');
                        statusText.textContent = 'You are doing great!';
                    } else if (points >= 300) {
                        progressBar.classList.add('bg-orange-400');
                        statusText.textContent = 'You are doing OK!';
                    } else {
                        progressBar.classList.add('bg-red-600');
                        statusText.textContent = 'You are doing horrible!';
                    }
                    document.getElementById('points').textContent = points + ' points';
                }
                pBar({{$points}});
                //delete button
                const habits = document.querySelectorAll('.task');
                habits.forEach(habit => {
                    const dForm = habit.querySelector(".delete-form");
                    const addForm = habit.querySelector(".addPoints-form");
                    const removeForm = habit.querySelector(".removePoints-form");
                    const completeD = habit.querySelector(".completeD-form");
                    const completeL = habit.querySelector(".completeL-form");

                    dForm.addEventListener('submit', function (e) {
                        e.preventDefault();

                        const action = this.action;

                        fetch(action, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                        })
                            .then(response => {
                                if (response.ok) {
                                    return response.json();
                                } else {
                                    throw new Error('Failed to delete the habit');
                                }
                            })
                            .then(data => {
                                if (data.success) {
                                    pBar(data.points);
                                    habit.classList.add('hidden');
                                } else {
                                    console.error('Failed to delete the habit');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    });
                    //add points button
                   if(addForm)
                   {
                       addForm.addEventListener('submit', function (e) {
                           e.preventDefault();

                           const action = this.action;

                           fetch(action, {
                               method: 'POST',
                               headers: {
                                   'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                   'Content-Type': 'application/json',
                                   'Accept': 'application/json',
                               },
                           })
                               .then(response => {
                                   if (response.ok) {
                                       return response.json();
                                   } else {
                                       throw new Error('Failed to add points');
                                   }
                               })
                               .then(data => {
                                   if (data.success) {
                                       pBar(data.points);
                                   } else {
                                       console.error('Failed to add points');
                                   }
                               })
                               .catch(error => {
                                   console.error('Error:', error);
                               });
                       });
                   }
                    //remove points button
                    if(removeForm)
                    {
                        removeForm.addEventListener('submit', function (e) {
                            e.preventDefault();

                            const action = this.action;

                            fetch(action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                },
                            })
                                .then(response => {
                                    if (response.ok) {
                                        return response.json();
                                    } else {
                                        throw new Error('Failed to delete points1');
                                    }
                                })
                                .then(data => {
                                    if (data.success) {
                                        pBar(data.points);
                                    } else {
                                        console.error('Failed to delete points2');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        });
                    }

                    //complete daily
                    if(completeD)
                    {
                        completeD.addEventListener('submit', function (e) {
                            e.preventDefault();

                            const action = this.action;

                            fetch(action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                },
                            })
                                .then(response => {
                                    if (response.ok) {
                                        return response.json();
                                    } else {
                                        throw new Error('Failed to complete the task');
                                    }
                                })
                                .then(data => {
                                    if (data.success) {
                                        pBar(data.points);
                                        const button = completeD.querySelector("#complete-button");
                                        const paragraph = document.createElement('p');
                                        paragraph.textContent = 'COMPLETED';
                                        paragraph.classList.add('text-xl', 'absolute', 'bottom-4', 'right-4', 'text-black');
                                        button.parentNode.insertBefore(paragraph, button);
                                        button.remove();
                                    } else {
                                        console.error('Failed to complete the task');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        });
                    }

                    //complete long term task
                    if(completeL)
                    {
                        completeL.addEventListener('submit', function (e) {
                            e.preventDefault();

                            const action = this.action;

                            fetch(action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                },
                            })
                                .then(response => {
                                    if (response.ok) {
                                        return response.json();
                                    } else {
                                        throw new Error('Failed to complete the task');
                                    }
                                })
                                .then(data => {
                                    if (data.success) {
                                        pBar(data.points);
                                        habit.classList.add('hidden');
                                    } else {
                                        console.error('Failed to complete the task');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        });
                    }
                });
            });
        </script>

    </main>
</div>
</body>
</html>
