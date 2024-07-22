<x-app-layout class="btn size-24 text-5xl bg-green-400  items-center text-black" href="{{ route('insertL') }}">
    @section('title', 'Long-term tasks') @section('header', 'Long-term task') @section('container','task-container')@section('content', 'Click the + button to add a new task.')
    @foreach($longTermTasks as $longTermTask)
        <div class="relative mockup-window border-base-300 border bg-green-100 mb-10">
            <div class=" absolute top-2 text-2xl left-20 ml-7 ">{{$longTermTask['date']}}</div>
            <div class="border-base-300 flex text-left text-3xl  order-t px-4 py-16 mb-8 uppercase">{{$longTermTask['name']}}</div>
            <button class="btn  text-xl bg-green-400  absolute bottom-4 right-4 text-black" >COMPLETE </button>
            <button class="btn text-2xl bg-red-400 absolute bottom-4 left-4 text-black">DELETE</button>
        </div>
    @endforeach
</x-app-layout>
