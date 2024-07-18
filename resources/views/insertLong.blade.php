<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Long-term tasks</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="/icon.ico">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-r from-green-500 to-blue-300 text-black flex flex-col items-start justify-start pt-12">
<h1 class="text-center w-full text-4xl md:text-7xl p-4 md:p-12">Create a new Long-term Task</h1>
<div class="w-full max-w-md mx-auto px-4">
    <input id="textInput" class="w-full border border-black bg-green-100 text-lg md:text-4xl p-2 mb-4" type="text" placeholder="Task Name">
    <div class="flex justify-center mb-4">
        <input datepicker id="datepicker" type="text" class="w-full border border-black bg-green-100 text-lg md:text-4xl p-2" placeholder="Select date" readonly>
    </div>
    <input id="createButton" class="w-full btn text-lg md:text-4xl bg-green-400 py-2 border rounded-3xl border-black text-black cursor-pointer" type="submit" value="Add">
</div>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>

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
        const taskNameL = document.getElementById('textInput').value;
        const taskLDate = document.getElementById('datepicker').value;
        if (taskNameL && taskLDate) {
            // Retrieve tasks from localStorage
            let tasksL = JSON.parse(localStorage.getItem('tasksL')) || [];
            let tasksLD = JSON.parse(localStorage.getItem('tasksLD')) || [];

            // Add new task to the array
            tasksL.push(taskNameL);
            tasksLD.push(taskLDate);

            // Save updated tasks array to localStorage
            localStorage.setItem('tasksL', JSON.stringify(tasksL));
            localStorage.setItem('tasksLD', JSON.stringify(tasksLD));

            // Redirect back to the LongTermTasks page
            window.location.href = '{{ route('LongTermTasks') }}';
        } else {
            alert('Please enter a task name and select a date.');
        }
    }
</script>
</body>
</html>
