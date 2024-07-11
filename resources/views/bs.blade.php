<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two Columns Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<!-- Header -->
<header class="bg-blue-500 text-white p-4">
    <nav class="container mx-auto flex justify-between">
        <a href="page1.html" class="hover:underline">Page 1</a>
        <a href="page2.html" class="hover:underline">Page 2</a>
        <a href="page3.html" class="hover:underline">Page 3</a>
    </nav>
</header>

<!-- Main Content -->
<div class="container mx-auto mt-6 flex">
    <!-- Wide Column -->
    <div class="w-3/4 bg-white p-4 shadow-lg" style="width: 8000px;">
        <h2 class="text-xl font-bold mb-4">Wide Column</h2>
        <p>This is the wide column. You can put more content here.</p>
    </div>

    <!-- Narrow Column -->
    <div class="w-1/4 bg-white p-4 shadow-lg ml-6" style="width: 1200px;">
        <h2 class="text-xl font-bold mb-4">Narrow Column</h2>
        <p>This is the narrow column. You can put additional content here.</p>
    </div>
</div>

</body>
</html>
