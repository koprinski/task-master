<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Daily tasks</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="/icon.ico">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-r from-green-500 to-blue-300 text-black flex flex-col items-center justify-center">
<h1 class="text-center text-4xl md:text-7xl p-4 md:p-24">Create a new Daily Task</h1>
<div class="w-full max-w-md mx-auto px-4">
    <input id="textInput" class="w-full border border-black bg-green-100 text-lg md:text-4xl p-2 mb-4" type="text" placeholder="Task Name">
    <input id="createButton" class="w-full btn text-lg md:text-4xl bg-green-400 py-2 border rounded-3xl border-black text-black cursor-pointer" type="submit" value="Add">
</div>

<script>
    // Focus on the input field when the page loads
    window.onload = function() {
        document.getElementById('textInput').focus();
    };

    document.getElementById('createButton').addEventListener('click', addTask);
    document.getElementById('textInput').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            addTask();
        }
    });

    function addTask() {
        const taskName = document.getElementById('textInput').value;
        if (taskName) {
            // Retrieve tasks from localStorage
            let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
            // Add new task to the array
            tasks.push(taskName);
            // Save updated tasks array to localStorage
            localStorage.setItem('tasks', JSON.stringify(tasks));
            // Redirect back to the DailyTasks page
            window.location.href = '{{ route('DailyTasks') }}';
        } else {
            alert('Please enter a task name.');
        }
    }
</script>
</body>
</html>
