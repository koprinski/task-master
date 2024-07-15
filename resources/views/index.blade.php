<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskMaster</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="/icon.ico">
</head>
<body class="bg-gradient-to-r from-green-300 to-blue-300 flex items-center justify-center min-h-screen p-6">
<div class="max-w-3xl w-full min-h-[100vh] bg-white shadow-md rounded-lg p-8 flex flex-col justify-between">
    <div class="flex justify-center mb-6">
        <a href="/">
            <img src="/logo.png" alt="sad" class="h-[150px] w-[500px]">
        </a>

    </div>
    <h1 class="text-3xl font-bold text-center mb-4">Welcome to TaskMaster</h1>
    <p class="text-center text-gray-600 mb-6">TaskMaster is your ultimate to-do-list app, designed to help you manage your tasks efficiently and stay organized. Whether you're juggling work projects, personal goals, or daily errands.</p>
    <div class="flex justify-center space-x-4 mt-auto">
        <a href="{{route('login')}}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 ">Login</a>
        <a href="{{route('register')}}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Register</a>
    </div>

</div>
</body>
</html>
