<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Habits</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="/icon.ico">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-r from-green-500 to-blue-300 text-black flex flex-col items-center justify-center">

<h1 class="text-center text-4xl md:text-7xl p-4 md:p-24">Create a new Habit</h1>
<div class="w-full max-w-md mx-auto px-4">
    <form method="POST" action="{{route('insert.habit')}}">
        @csrf
        <input name="name" id="textInput" class="w-full border border-black bg-green-100 text-lg md:text-4xl p-2 mb-4" type="text" placeholder="Habit Name" required>
        @error('name')
        <p class="text-red-600 bold text-2xl"> {{$message}} </p>
        @enderror
        <input id="createButton" class="w-full btn text-lg md:text-4xl bg-green-400 py-2 border rounded-3xl border-black text-black cursor-pointer" type="submit" value="Add">
    </form>
</div>


<script>
    // Focus on the input field when the page loads
    window.onload = function() {
        document.getElementById('textInput').focus();
    };
</script>
</body>
</html>
