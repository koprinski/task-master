
<x-guest-layout>
<div class=" p-6 rounded-lg shadow-lg w-96">
    <h2 class="text-2xl font-bold mb-4 text-center">Enter Your Username</h2>
    <form>
        <div class="mb-4">
            <input id="usernameInput" class="block w-full p-2 border border-gray-300 rounded-lg text-gray-900" type="text" placeholder="Username">
        </div>
        <div class="flex justify-end">
            <x-primary-button class="ms-3">Submit</x-primary-button>
        </div>
    </form>
</div>
    <script>
        window.onload = function() {
            document.getElementById('usernameInput').focus();
        };
    </script>
    </x-guest-layout>
