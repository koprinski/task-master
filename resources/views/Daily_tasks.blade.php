<x-app-layout>


    <div class="relative col-span-4 row-span-4 bg-white p-4 mr-4 shadow-lg max-h-[700px] overflow-scroll ">
        <h2 class="text-4xl font-bold mb-4">Daily tasks</h2>

        <div id="task-container"></div>
        <p class="text-2xl mt-10">Click the + button to add a new task.</p>

        <div class="">

        </div>

    </div>
    <div class="col-span-2 m row-span-3 bg-white p-4 shadow-lg max-w-4xl ml-6 i " >

        <div class="text-center m-4 ">
            <div class="avatar ">
                <div class="size-24 rounded-full">
                    <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                </div>

            </div>
        </div>
        <div class="text-center m-6 border-b text-3xl">
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

        <a class="btn size-24 text-5xl bg-green-400  ml-48" href="{{ route('insertD') }}"> +</a>
    </div>

    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Retrieve habits from localStorage
            const tasks = JSON.parse(localStorage.getItem('tasks')) || [];
            tasks.forEach(task => addDailyTaskBlock(task));

            function addDailyTaskBlock(taskName) {
                const taskContainer = document.getElementById('task-container');
                const taskBlock = document.createElement('div');
                taskBlock.className = "relative mockup-window border-base-300 border bg-green-100 mb-24";
                taskBlock.innerHTML = `
                    <div class="border-base-300 flex text-left text-3xl border-t px-4 py-16 mb-8 uppercase">
                        ${taskName}
                    </div>
                     <button class="btn  text-2xl bg-green-400  absolute bottom-4 right-4">COMPLETE TASK</button>
                    <button class="btn text-2xl bg-red-400 absolute bottom-4 left-4">DELETE TASK</button>
                `;
                taskContainer.appendChild(taskBlock);

                // Add delete habit event
                taskBlock.querySelector('.bg-red-400').addEventListener('click', () => {
                    deleteTask(taskName);
                    taskBlock.remove();
                });
                taskBlock.querySelector('.bg-green-400').addEventListener('click', () => {
                    addPoints();
                    deleteTask(taskName);
                    taskBlock.remove();
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
