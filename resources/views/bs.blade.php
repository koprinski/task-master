<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Text Block</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
<div class="container mx-auto">
    <div class="mb-4">
        <input id="inputText" type="text" placeholder="Enter text" class="border border-gray-300 p-2 rounded w-full">
        <button onclick="createTextBlock()" class="mt-2 btn bg-blue-500 text-white p-2 rounded">Create Text Block</button>
    </div>
    <div id="textBlockContainer" class="space-y-4"></div>
</div>

<script>
    function createTextBlock() {
        const inputText = document.getElementById('inputText').value;
        if (inputText.trim() === '') {
            alert('Please enter some text');
            return;
        }

        const container = document.getElementById('textBlockContainer');

        const textBlock = document.createElement('div');
        textBlock.className = 'relative mockup-window border-base-300 border bg-green-100';

        const textDiv = document.createElement('div');
        textDiv.className = 'border-base-300 flex text-left text-3xl border-t px-4 py-16 mb-8 uppercase';
        textDiv.innerText = inputText;

        const minusButton = document.createElement('button');
        minusButton.className = 'btn size-12 text-4xl bg-red-600 absolute bottom-4 right-20';
        minusButton.innerText = '-';

        const plusButton = document.createElement('button');
        plusButton.className = 'btn size-12 text-4xl bg-green-400 absolute bottom-4 right-4';
        plusButton.innerText = '+';

        const deleteButton = document.createElement('button');
        deleteButton.className = 'btn text-2xl bg-red-400 absolute bottom-4 left-4';
        deleteButton.innerText = 'DELETE HABIT';
        deleteButton.onclick = function () {
            container.removeChild(textBlock);
        };

        textBlock.appendChild(textDiv);
        textBlock.appendChild(minusButton);
        textBlock.appendChild(plusButton);
        textBlock.appendChild(deleteButton);

        container.appendChild(textBlock);

        document.getElementById('inputText').value = '';
    }
</script>
</body>
</html>
