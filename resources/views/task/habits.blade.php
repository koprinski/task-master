<x-app-layout class="btn size-24 text-5xl bg-green-400  items-center text-black" href="{{ route('insertH') }}">
    @section('title', 'Habits') @section('header', 'Habits') @section('container','habits-container') @section('content', 'Click the + button to add a new habit.')
    @foreach($habits as $habit)
        <div class="relative mockup-window border-base-300 border bg-green-100 mb-10">
            <div class="border-base-300 flex text-left text-3xl  order-t px-4 py-16 mb-8 uppercase">{{$habit['name']}}</div>
            <button class="btn size-12 text-4xl bg-red-600  absolute bottom-4 right-20">-</button>
            <button class="btn size-12 text-4xl bg-green-400 absolute bottom-4 right-4 text-black">+</button>
            <button class="btn text-2xl bg-red-400 absolute bottom-4 left-4 text-black">DELETE</button>
        </div>
    @endforeach


</x-app-layout>
