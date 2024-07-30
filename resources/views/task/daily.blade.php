<x-app-layout class="btn size-24 text-5xl bg-green-400  items-center text-black" href="{{ route('iDaily') }}">

    @section('title', 'Daily Tasks') @section('header', 'Daily tasks') @section('container','task-container')@section('content', 'Click the + button to add a new task.')
{{--    @php(dd(\Illuminate\Support\Facades\Auth::user()->checkedModal))--}}
    @if(\Illuminate\Support\Facades\Auth::user()->checkedModal == false)  @include('dailyModal')  @endif
{{--    @include('dailyModal')--}}
    @foreach($dailyTasks as $dailyTask)
        <div class="relative mockup-window border-base-300 border bg-green-100 mb-10 task">
            <div class="border-base-300 flex text-left text-3xl  order-t px-4 py-16 mb-8 uppercase">{{$dailyTask['name']}}</div>
            @if($dailyTask['completed'])
                <p class="text-xl absolute bottom-4 right-4 text-black" >COMPLETED @if($dailyTask['count'] > 1): {{$dailyTask['count']}}  @endif</p>
            @else
                <form method="POST" action="{{route('daily.complete',['id'=> $dailyTask['id']])}}" class="completeD-form">
                    @csrf
                    @method('POST')
                    <button id="complete-button" type="submit" class="btn  text-xl bg-green-400  absolute bottom-4 right-4 text-black" >COMPLETE </button>
                </form>
            @endif
            <form method="POST" action="{{route('daily.delete',['id'=> $dailyTask['id']])}}" class="delete-form">
                @method('DELETE')
                @csrf
                <button class="btn text-xl bg-red-400 absolute bottom-4 left-4 text-black" type="submit">DELETE </button>
            </form>        </div>
    @endforeach




</x-app-layout>
