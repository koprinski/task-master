<!doctype html>
<html lang="en">
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
<body class="h-screen bg-gradient-to-r from-green-500 to-blue-300">
<h1 class="justify-center text-center text-7xl p-24">Create a new Habit</h1>
<div class="justify-center text-center text-6xl">
    <label>Habit Name:</label>
    <input id="textInput" class="border border-black bg-green-100" type="text"><br><br>
    <input id="createButton" class="btn text-4xl bg-green-400 size-40 border rounded-3xl border-black" type="submit" value="Add">
</div>

<script>
    document.getElementById('createButton').addEventListener('click', function() {
        const habitName = document.getElementById('textInput').value;
        if (habitName) {
            // Retrieve habits from localStorage
            let habits = JSON.parse(localStorage.getItem('habits')) || [];
            // Add new habit to the array
            habits.push(habitName);
            // Save updated habits array to localStorage
            localStorage.setItem('habits', JSON.stringify(habits));
            // Redirect back to the Habbits page
            window.location.href = '{{ route('Habbits') }}';
        } else {
            alert('Please enter a habit name.');
        }
    });
</script>
</body>
</html>
