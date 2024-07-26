<x-app-layout class="btn size-24 text-5xl bg-green-400  items-center text-black" href="{{ route('iLongTerm') }}">
    @section('title', 'Long-term tasks') @section('header', 'Long-term task') @section('container','task-container')@section('content', 'Click the + button to add a new task.')
    @foreach($longTermTasks as $longTermTask)
        @if($longTermTask['date'] > Carbon\Carbon::now())
            <div class="relative mockup-window border-base-300 border bg-green-100 mb-10 task">
                <div class=" absolute top-2 text-2xl left-20 ml-7 ">{{\Carbon\Carbon::parse($longTermTask['date'])->format('d/m/Y')}}</div>
                <div class="border-base-300 flex text-left text-3xl  order-t px-4 py-16 mb-8 uppercase">{{$longTermTask['name']}}</div>
                <form method="POST" action="{{route('longTerm.complete',['id'=> $longTermTask['id']])}}" class="completeL-form">
                    @csrf
                    @method('POST')
                    <button id="complete-button" type="submit" class="btn  text-xl bg-green-400  absolute bottom-4 right-4 text-black" >COMPLETE </button>
                </form>
                <form method="POST" action="{{route('longTerm.delete',['id'=> $longTermTask['id']])}}" class="delete-form">
                    @method('DELETE')
                    @csrf
                    <button class="btn text-xl bg-red-400 absolute bottom-4 left-4 text-black" type="submit">DELETE </button>
                </form>
            </div>
        @else
            <div class="relative mockup-window border-base-300 border bg-red-100 mb-10 task">
                <div class=" absolute top-2 text-2xl left-20 ml-7 ">{{\Carbon\Carbon::parse($longTermTask['date'])->format('d/m/Y')}}</div>
                <div class="border-base-300 flex text-left text-3xl  order-t px-4 py-16 mb-8 uppercase">{{$longTermTask['name']}}</div>
                <form method="POST" action="{{route('longTerm.complete',['id'=> $longTermTask['id']])}}" class="completeL-form">
                    @csrf
                    @method('POST')
                    <button id="complete-button" type="submit" class="btn  text-xl bg-green-400  absolute bottom-4 right-4 text-black" >COMPLETE </button>
                </form>
                <form method="POST" action="{{route('longTerm.delete',['id'=> $longTermTask['id']])}}" class="delete-form">
                    @method('DELETE')
                    @csrf
                    <button class="btn text-xl bg-red-400 absolute bottom-4 left-4 text-black" type="submit">GIVE UP </button>
                </form>
            </div>
        @endif
    @endforeach
</x-app-layout>
