<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Long-term tasks</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="icon" href="/icon.ico">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="min-h-screen bg-gradient-to-r from-green-500 to-blue-300 text-black flex flex-col items-start justify-start pt-12">
<h1 class="text-center w-full text-4xl md:text-7xl p-4 md:p-12">Create a new Long-term Task</h1>

<div class="w-full max-w-md mx-auto px-4">
    <form method="POST" action="{{route('insert.longTerm')}}">
        @csrf
        <input name="name" id="textInput" class="w-full border border-black bg-green-100 text-lg md:text-4xl p-2 mb-4" type="text" placeholder="Task Name" required>
        @error('name')
        <p class="text-red-600 bold text-2xl"> {{$message}} </p>
        @enderror
        <input datepicker name="date" id="datepicker" type="text" class="w-full border border-black bg-green-100 text-lg md:text-4xl p-2" placeholder="Select date" readonly required>
        @error('date')
        <p class="text-red-600 bold text-2xl"> {{$message}} </p>
        @enderror
        <input id="createButton" class="w-full btn text-lg md:text-4xl bg-green-400 py-2 border rounded-3xl border-black text-black cursor-pointer mt-12" type="submit" value="Add">
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>

<script>
    // Focus on the input field when the page loads
    window.onload = function () {
        document.getElementById('textInput').focus();
    };
</script>
</body>
</html>
