<!-- resources/views/components/habit-block.blade.php -->
<div class="relative mockup-window border-base-300 border bg-green-100 mb-4">
    <div class="border-base-300 flex text-left text-3xl border-t px-4 py-16 mb-8 uppercase">
        {{ $habitName }}
    </div>
    <button class="btn size-12 text-4xl bg-red-600 absolute bottom-4 right-20">-</button>
    <button class="btn size-12 text-4xl bg-green-400 absolute bottom-4 right-4">+</button>
    <button class="btn text-2xl bg-red-400 absolute bottom-4 left-4">DELETE HABIT</button>
</div>
