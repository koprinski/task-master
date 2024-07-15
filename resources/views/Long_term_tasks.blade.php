<x-app-layout class="btn size-24 text-5xl bg-green-400  items-center" href="{{ route('insertL') }}">

    <div class="relative col-span-4 row-span-4 bg-white p-4 mr-4 shadow-lg max-h-[700px] overflow-scroll ">
        <h2 class="text-4xl font-bold mb-4">Long-term tasks</h2>
        <div id="task-container"></div>
        <p class="text-2xl mt-10">Click the + button to add a new task.</p>

        <div class="">

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Retrieve habits from localStorage
            const tasksL = JSON.parse(localStorage.getItem('tasksL')) || [];
            tasksL.forEach(taskL => addDailyTaskBlock(taskL));

            function addDailyTaskBlock(taskNameL) {
                const taskContainerL = document.getElementById('task-container');
                const taskBlockL = document.createElement('div');
                taskBlockL.className = "relative mockup-window border-base-300 border bg-green-100 mb-24";
                taskBlockL.innerHTML = `
                    <div class="border-base-300 flex text-left text-3xl border-t px-4 py-16 mb-8 uppercase">
                        ${taskNameL}
                    </div>
                     <button class="btn  text-2xl bg-green-400  absolute bottom-4 right-4">COMPLETE TASK</button>
                    <button class="btn text-2xl bg-red-400 absolute bottom-4 left-4">DELETE TASK</button>
                `;
                taskContainerL.appendChild(taskBlockL);

                // Add delete habit event
                taskBlockL.querySelector('.bg-red-400').addEventListener('click', () => {
                    deleteTask(taskNameL);
                    taskBlockL.remove();
                });
                taskBlockL.querySelector('.bg-green-400').addEventListener('click', () => {
                    addPoints();
                    deleteTask(taskNameL);
                    taskBlockL.remove();
                });
            }

            function deleteTask(taskNameL) {
                let tasksL = JSON.parse(localStorage.getItem('tasksL')) || [];
                tasksL = tasksL.filter(taskL => taskL !== taskNameL);
                localStorage.setItem('tasksL', JSON.stringify(tasksL));
            }
            function addPoints() {
                let points = parseInt(localStorage.getItem("points"), 10) || 0;
                points += 300;
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
