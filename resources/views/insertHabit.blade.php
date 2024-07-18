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
    <input id="textInput" class="w-full border border-black bg-green-100 text-lg md:text-4xl p-2 mb-4" placeholder="Habit Name" type="text">
    <input id="createButton" class="w-full btn text-lg md:text-4xl bg-green-400 py-2 border rounded-3xl border-black text-black cursor-pointer" type="submit" value="Add">
</div>

<script>
    // Focus on the input field when the page loads
    window.onload = function() {
        document.getElementById('textInput').focus();
    };

    document.getElementById('createButton').addEventListener('click', addHabit);
    document.getElementById('textInput').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            addHabit();
        }
    });

    function addHabit() {
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
    }
</script>
</body>
</html>
