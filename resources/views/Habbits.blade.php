<x-app-layout>
    <div class="relative col-span-4 row-span-4 bg-white p-4 mr-4 shadow-lg ">
        <h2 class="text-4xl font-bold mb-4">Habits</h2>

        {{-- The block needs to appear here --}}
        <div id="habits-container">
            <!-- Dynamic habit blocks will be inserted here -->
        </div>

        <p class="text-2xl mt-10">Click the + button to add a new habit.</p>

        <div>
            <a class="btn size-24 text-5xl bg-green-400 absolute bottom-4 right-4" href="{{ route('insertH') }}"> +</a>
        </div>
    </div>

    <!-- Include the script to handle habit block creation -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Retrieve habits from localStorage
            const habits = JSON.parse(localStorage.getItem('habits')) || [];
            habits.forEach(habit => addHabitBlock(habit));

            function addHabitBlock(habitName) {
                const habitsContainer = document.getElementById('habits-container');
                const habitBlock = document.createElement('div');
                habitBlock.className = "relative mockup-window border-base-300 border bg-green-100 mb-24";
                habitBlock.innerHTML = `
                    <div class="border-base-300 flex text-left text-3xl border-t px-4 py-16 mb-8 uppercase">
                        ${habitName}
                    </div>
                    <button class="btn size-12 text-4xl bg-red-600 absolute bottom-4 right-20">-</button>
                    <button class="btn size-12 text-4xl bg-green-400 absolute bottom-4 right-4">+</button>
                    <button class="btn text-2xl bg-red-400 absolute bottom-4 left-4">DELETE HABIT</button>
                `;
                habitsContainer.appendChild(habitBlock);

                // Add delete habit event
                habitBlock.querySelector('.bg-red-400').addEventListener('click', () => {
                    deleteHabit(habitName);
                    habitBlock.remove();
                });
                habitBlock.querySelector('.bg-green-400').addEventListener('click', () => {
                    addPoints();
                });
                habitBlock.querySelector('.bg-red-600').addEventListener('click', () => {
                    removePoints();
                });
            }

            function deleteHabit(habitName) {
                let habits = JSON.parse(localStorage.getItem('habits')) || [];
                habits = habits.filter(habit => habit !== habitName);
                localStorage.setItem('habits', JSON.stringify(habits));
            }

            function addPoints() {
                let points = parseInt(localStorage.getItem("points"), 10) || 0;
                points += 50;
                localStorage.setItem("points", points.toString());
                updatePointsDisplay(points);
            }

            function removePoints() {
                let points = parseInt(localStorage.getItem("points"), 10) || 0;
                points -= 100;
                localStorage.setItem("points", points.toString());
                updatePointsDisplay(points);
            }

            function updatePointsDisplay(points) {
                const progressBar = document.getElementById('progress-bar');
                const statusText = document.getElementById('status-text');

                // Update points text
                document.getElementById('points').textContent = points + ' points';

                // Clear previous classes
                progressBar.classList.remove('bg-green-400', 'bg-orange-400', 'bg-red-600');

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
            }
        });
    </script>
</x-app-layout>
