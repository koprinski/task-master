<x-app-layout class="btn size-24 text-5xl bg-green-400  items-center text-black" href="{{ route('insertH') }}">
    @section('title', 'Habits') @section('header', 'Habits') @section('container','habits-container')
    <!-- Include the script to handle habit block creation -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Retrieve habits from localStorage
            const habits = JSON.parse(localStorage.getItem('habits')) || [];
            habits.forEach(habit => addHabitBlock(habit));

            function addHabitBlock(habitName) {
                const habitsContainer = document.getElementById('habits-container');
                const habitBlock = document.createElement('div');
                habitBlock.className = "relative mockup-window border-base-300 border bg-green-100 mb-10";
                habitBlock.innerHTML = `
                    <div class="border-base-300 flex text-left text-3xl  order-t px-4 py-16 mb-8 uppercase">
                        ${habitName}
                    </div>
                    <button class="btn size-12  text-4xl bg-red-600  absolute bottom-4 right-20 text-black">-</button>
                    <button class="btn size-12 text-4xl bg-green-400 absolute bottom-4 right-4 text-black">+</button>
                    <button class="btn text-2xl bg-red-400 absolute bottom-4 left-4 text-black">DELETE HABIT</button>
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
