<x-app-layout>
    <div class=" mt-6 w-full ">
        <div class="grid grid-cols-6 grid-rows-6 gap-4 m-24">
            <!-- Wide Column -->
            <div class="relative col-span-4 row-span-4 bg-white p-4 mr-4 shadow-lg ">
                <h2 class="text-4xl font-bold mb-4">Habits</h2>
                <div class="relative mockup-window border-base-300 border bg-green-100">
                    <div class="border-base-300 flex text-left text-3xl  border-t px-4 py-16 mb-8 uppercase">SLEEP AT LEAST 8 HOURS</div>
                    <button class="btn size-12 text-4xl bg-red-600  absolute bottom-4 right-20">-</button>
                    <button class="btn size-12 text-4xl bg-green-400  absolute bottom-4 right-4">+</button>
                    <button class="btn text-2xl bg-red-400 absolute bottom-4 left-4">DELETE HABIT</button>
                </div>


                <p class="text-2xl mt-10">Click the + button to add a new habit.</p>

                <div class="">
                    <button class="btn size-24 text-5xl bg-green-400  absolute bottom-4 right-4">+</button>
                </div>

            </div>

            <!-- Narrow Column -->
            <div class="col-span-2 row-span-3 bg-white p-4 shadow-lg " >

                <div class="text-center m-24 ">
                    <div class="avatar ">
                        <div class="size-48 rounded-full">
                            <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                        </div>

                    </div>
                </div>
                <div class="text-center m-6 border-b text-5xl">
                    <p> Username </p>
                </div>
                <div>
                    <div class="text-3xl text-center m-7">Status</div>
                    <div class="w-full max-w-xl mx-auto">
                        <div class="w-full  rounded-full h-6 ">
                            <div id="progress-bar" class="h-6 rounded-full " ></div>
                        </div>
                        <div  class="text-center text-xl mt-2" id="points">0 points</div>
                    </div>


                </div>

                <div id="status-text" class="text-4xl text-center m-7">

                </div>

            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const points = 100; // Example points data
            const progressBar = document.getElementById('progress-bar');
            const statusText = document.getElementById('status-text');

            // Update progress bar color based on points
            if (points >= 700) {
                progressBar.classList.add('bg-green-400');
                statusText.textContent = 'You are doing great!';
            } else if (points >= 300) {
                progressBar.classList.add('bg-orange-400');
                statusText.textContent = 'You are doing OK!';
            } else {
                progressBar.classList.add('bg-red-600');
                statusText.textContent = 'You are doing horrible!';
            }

            // Update points text
            document.getElementById('points').textContent = points + ' points';
        });
    </script>
</x-app-layout>
