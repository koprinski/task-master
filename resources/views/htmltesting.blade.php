<x-app-layout>

    <div class=" mt-6 w-full ">
        <div class="grid grid-cols-6 grid-rows-6 gap-4 m-24">
            <!-- Wide Column -->
            <div class="relative col-span-4 row-span-4 bg-white p-4 mr-4 shadow-lg ">
                <h2 class="text-4xl font-bold mb-4">Habits</h2>
                <div class="relative mockup-window border-base-300 border bg-green-100">
                    <div class="border-base-300 flex text-left text-2xl  border-t px-4 py-16 mb-8 ">SLEEP AT LEAST 8 HOURS</div>
                    <button class="btn size-12 text-4xl bg-red-600  absolute bottom-4 right-20">-</button>
                    <button class="btn size-12 text-4xl bg-green-400  absolute bottom-4 right-4">+</button>
                    <button class="btn text-2xl bg-red-400 absolute bottom-4 left-4">DELETE TASK</button>
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
                        <div class="h-6 bg-green-400 rounded-full dark:bg-blue-500 text-center text-xl"> 1000 points</div>
                </div>

                <div class="text-4xl text-center m-7">
                    <p> You are doing great! </p>
                </div>
            </div>

            </div>
        </div>
</x-app-layout>
