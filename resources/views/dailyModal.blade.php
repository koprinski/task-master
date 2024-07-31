<div class="container mx-auto p-4">
    <!-- Button to open the modal -->
{{--    <button id="openModalBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">--}}
{{--        Open Modal--}}
{{--    </button>--}}

    <!-- Modal -->
    <div id="myModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50   ">
        <div class="max-h-[700px] overflow-scroll bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Tasks you may have forgotten to check yesterday.
                </h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">
                    @foreach($dailyTasks as $dailyTask)
                      @if($dailyTask['completed'] == false)
                            <div class="relative mockup-window border-base-300 border bg-green-100 mb-10 task">
                                <div class="border-base-300 flex text-left text-3xl  order-t px-4 py-16 mb-8 uppercase">{{$dailyTask['name']}}</div>
                                <form method="POST" action="{{route('daily.complete',['id'=> $dailyTask['id']])}}" class="completeD-form">
                                    @csrf
                                    @method('POST')
                                    <button id="complete-button" type="submit" class="btn  text-xl bg-green-400  absolute bottom-4 right-4 text-black" >COMPLETE </button>
                                </form>
                                <form method="GET" action="{{route('daily.delete',['id'=> $dailyTask['id']])}}" class="delete-form">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn text-xl bg-red-400 absolute bottom-4 left-4 text-black" type="submit">DELETE </button>
                                </form>        </div>
                      @endif
                        @endforeach
                </div>
                <div class="mt-5 sm:mt-6">
                    <form method="POST" action="{{route('closeModal')}}">
                        @csrf
                        <button id="closeModalBtn" class="bg-red-400 text-black  py-2 px-4 rounded" type="submit">
                            Close
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{--<script>--}}
{{--    document.getElementById('openModalBtn').addEventListener('click', function() {--}}
{{--        document.getElementById('myModal').classList.remove('hidden');--}}
{{--        document.getElementById('myModal').classList.add('flex');--}}
{{--    });--}}

{{--    document.getElementById('closeModalBtn').addEventListener('click', function() {--}}
{{--        document.getElementById('myModal').classList.add('hidden');--}}
{{--        document.getElementById('myModal').classList.remove('flex');--}}
{{--    });--}}
{{--</script>--}}
