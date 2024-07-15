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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen bg-gradient-to-r from-green-500 to-blue-300">
<h1 class="justify-center text-center text-7xl p-24">Create a new Daily Task</h1>
<div class="justify-center text-center text-6xl">

    <input id="textInput" class="border border-black bg-green-100 text-4xl" type="text" placeholder="Task Name" name="taskn_name"><br><br>
    <input id="createButton" class="btn text-4xl bg-green-400 size-40 border rounded-3xl border-black" type="submit" value="Add">
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
            // Retrieve habits from localStorage
            let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
            // Add new habit to the array
            tasks.push(taskName);
            // Save updated habits array to localStorage
            localStorage.setItem('tasks', JSON.stringify(tasks));
            // Redirect back to the Habbits page
            window.location.href = '{{ route('DailyTasks') }}';
        } else {
            alert('Please enter a task name.');
        }
    }
</script>
</body>
</html>
