<x-app-layout class="btn size-24 text-5xl bg-green-400  items-center" href="{{ route('insertD') }}">

    @section('title', 'Daily Tasks')
    <div class="relative col-span-4 row-span-4 bg-white p-4 mr-4 shadow-lg max-h-[700px] overflow-scroll ">
        <h2 class="text-4xl font-bold mb-4">Daily tasks</h2>

        <div id="task-container"></div>
        <p class="text-2xl mt-10">Click the + button to add a new task.</p>

        <div class="">

        </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tasks = JSON.parse(@json($aaa)) || [];
            tasks.forEach(task => addDailyTaskBlock(task));

            function addDailyTaskBlock(taskName) {
                const taskContainer = document.getElementById('task-container');
                const taskBlock = document.createElement('div');
                taskBlock.className = "relative mockup-window border-base-300 border bg-green-100 mb-24";
                taskBlock.innerHTML = `
                    <div class="border-base-300 flex text-left text-3xl border-t px-4 py-16 mb-8 uppercase">
                        ${taskName}
                    </div>
                    <form action="{{ route('daily-tasks-delete') }}" method="GET">
                        @csrf
                <input type="hidden" name="task_name" value="${taskName}">
                        <button type="submit" class="btn text-2xl bg-red-400 absolute bottom-4 left-4">DELETE TASK</button>
                    </form>
                    <button class="btn text-2xl bg-green-400 absolute bottom-4 right-4">COMPLETE TASK</button>
                `;
                taskContainer.appendChild(taskBlock);

                // Add event listener for the complete task button
                taskBlock.querySelector('.bg-green-400').addEventListener('click', () => {
                    addPoints();
                    deleteTask(taskName);
                   // taskBlock.remove();
                });
            }

            function deleteTask(taskName) {
                let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
                tasks = tasks.filter(task => task !== taskName);
                localStorage.setItem('tasks', JSON.stringify(tasks));
            }

            function addPoints() {
                let points = parseInt(localStorage.getItem("points"), 10) || 0;
                points += 100;
                localStorage.setItem("points", points.toString());
                updatePointsDisplay(points);
            }

            function updatePointsDisplay(points) {
                const progressBar = document.getElementById('progress-bar');
                const statusText = document.getElementById('status-text');

                document.getElementById('points').textContent = points + ' points';
                progressBar.classList.remove('bg-green-400', 'bg-orange-400', 'bg-red-600');

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
