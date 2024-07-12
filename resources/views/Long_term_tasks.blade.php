<x-app-layout>

    <div class="relative col-span-4 row-span-4 bg-white p-4 mr-4 shadow-lg ">
        <h2 class="text-4xl font-bold mb-4">Long-term tasks</h2>
        <div id="task-container"></div>
        <p class="text-2xl mt-10">Click the + button to add a new task.</p>

        <div class="">
            <a class="btn size-24 text-5xl bg-green-400  absolute bottom-4 right-4" href="{{route('insertL')}}">+</a>
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
                    <button class="btn text-2xl bg-red-400 absolute bottom-4 left-4">DELETE HABIT</button>
                `;
                taskContainerL.appendChild(taskBlockL);

                // Add delete habit event
                taskBlockL.querySelector('.bg-red-400').addEventListener('click', () => {
                    deleteTask(taskNameL);
                    taskBlockL.remove();
                });
            }

            function deleteTask(taskNameL) {
                let tasksL = JSON.parse(localStorage.getItem('tasksL')) || [];
                tasksL = tasksL.filter(taskL => taskL !== taskNameL);
                localStorage.setItem('tasks', JSON.stringify(tasksL));
            }
        });
    </script>
</x-app-layout>
