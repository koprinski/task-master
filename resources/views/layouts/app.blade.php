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
                    <div id="@yield('container')">
                        <div class="flex items-center justify-center p-0 m-0">
                            <div role="status" class="loader p-0 m-0">
                                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-500  justify-center p-0 m-0" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="hider hidden">
                           {{$slot}}
                       </div>
                    </div>

                    <p class="text-2xl mt-10">@yield('content')</p>
                </div>

                <!-- Narrow Column -->
                <div class="col-span-1 lg:col-span-2 bg-white p-4 shadow-lg">
                    <div class="flex justify-center items-center">
                        <div>
                            <img src="/logo.png" alt="logo" class="h-24  w-auto">
                        </div>
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
                            <div class="text-center text-xl mt-2" id="points">{{\Illuminate\Support\Facades\Auth::user()->points}} points</div>
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
            document.addEventListener('DOMContentLoaded', function() {
                // Select the element with class 'hider'
                if(performance.getEntriesByType("navigation")[0].type === 'back_forward' ){
                    location.reload();
                }
                var hiderElement = document.querySelector('.hider');
                var loader = document.querySelector('.loader');
                // Set a timeout to remove the 'hidden' class after 1 second (1000 milliseconds)
                setTimeout(function() {
                    loader.classList.remove('hidden');
                    loader.classList.add('hidden');
                    hiderElement.classList.remove('hidden');
                }, 300);
            });

            //number animation
            function animateValue(obj, start, end, duration) {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    obj.innerHTML = Math.floor(progress * (end - start) + start);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }
            //progress bar
                function pBar(points)
                {
                    const progressBar = document.getElementById('progress-bar');
                    const statusText = document.getElementById('status-text');

                    progressBar.className = 'h-6 rounded-full bg-gradient-to-r';

                    const progressBarClasses = [
                        { max: 0, classes: ['from-red-900', 'to-red-800'], text: 'You are doing horrible!' },
                        { max: 100, classes: ['from-red-800', 'to-red-700'], text: 'You are doing horrible!' },
                        { max: 200, classes: ['from-red-700', 'to-red-600'], text: 'You are doing horrible!' },
                        { max: 300, classes: ['from-red-600', 'to-red-500'], text: 'You are doing horrible!' },
                        { max: 400, classes: ['from-red-600', 'to-orange-600'], text: 'You are doing horrible!' },
                        { max: 500, classes: ['from-orange-600', 'to-orange-500'], text: 'You are doing OK!' },
                        { max: 600, classes: ['from-orange-500', 'to-orange-400'], text: 'You are doing OK!' },
                        { max: 700, classes: ['from-orange-400', 'to-yellow-300'], text: 'You are doing OK!' },
                        { max: 800, classes: ['from-yellow-300', 'to-yellow-200'], text: 'You are doing good!' },
                        { max: 900, classes: ['from-yellow-200', 'to-lime-200'], text: 'You are doing good!' },
                        { max: 1000, classes: ['from-lime-200', 'to-lime-300'], text: 'You are doing good!' },
                        { max: 1100, classes: ['from-lime-300', 'to-green-300'], text: 'You are doing excellent!' },
                        { max: 1200, classes: ['from-green-300', 'to-green-400'], text: 'You are doing excellent!' },
                        { max: Infinity, classes: [], text: 'You are outstanding!' },
                    ];
                    let defaultClass = { classes: [], text: '' };
                    const progressBarClass = progressBarClasses.find(range => points <= range.max) || defaultClass;
                    progressBar.classList.add(...progressBarClass.classes);
                    statusText.textContent = progressBarClass.text;
                    const  old_points =  Number(document.getElementById('points').innerText.split(' ')[0]);
                    const points_div = document.getElementById('points');
                    animateValue(points_div,  old_points, points, 1000);
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
                        // const csrfToken =document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        fetch(action, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN':'{{ csrf_token() }}',
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
                                    console.log(data)
                                    pBar(data.points);
                                    habit.remove();
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
                                        if(data.count > 1) {paragraph.textContent = 'COMPLETED: '.concat(String(data.count));} else {paragraph.textContent = 'COMPLETED';}
                                        paragraph.classList.add('text-xl', 'absolute', 'bottom-6', 'right-4', 'text-black');
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
        </script>

    </main>
</div>
</body>
</html>
