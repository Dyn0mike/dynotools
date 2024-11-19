@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-2/6 bg-white p-6 rounded-lg">
            <a href="{{ route('buy') }}" class="text-white bg-blue-700 hover:bg-blue-800 
            focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none 
            dark:focus:ring-blue-800">Set up a buy order.</a>
        </div>
    </div>|
    <br>
    <div class="flex justify-center">
        <div class="w-2/6 bg-white p-8 rounded-lg border-2">
            <h1 class="text-4xl font-extrabold dark:text-gray">How to sell:</h1>
            <ul class="list-disc">
                <li>Find which buy order will be fulfilled by your escalation. Befor selling, message the buyer on discord and confirm they are still buying.</li></br>
                <li>In-game, create a bookmark of your escalation on the gate of the escalation.</li></br>
                <li>Eve mail the buyer listed in the buy order. In the evemail, 
                    include a shared bookmark folder with your escalation bookmark. Make sure the listed character is the only person on the Access List to the folder.</li></br>
                <li>All of this must be done within a short period of receiving the escalation.</li></br>
              </ul>
        </div>
        <div class="w-2/6 bg-white p-8 rounded-lg border-2">
            <h1 class="text-4xl font-extrabold dark:text-gray">Safety information:</h1>
            <ul class="list-disc">
                <li>Always message the buyer and confirm they are a member of a friendly alliance.</li></br>
                <li>Don't buy off people with no security status.</li></br>
                <li>Be cautious of members newer then two months.</li></br>
                <li>Double check the above twice when selling to corps like Pandemic Horde Inc and Acrtic Beans.</li></br>
              </ul>

        </div>
    </div>
    <br>
    <div class="container mx-auto">
        <h1 class="text-4xl font-extrabold dark:text-gray">Buy Orders:</h1>
        <div class="flex flex-wrap -mx-4">
            
            <br>

                @foreach ($buys as $buy)
    
                <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 p-4">
                    <div class="c-card block bg-white shadow-md rounded-lg overflow-hidden p-3">
                    <p class="font-medium">Character:</p>{{$buy->name }}<br><br>
                    <p class="font-medium">Discord:</p>{{$buy->discord }}<br><br>
                    <p class="font-medium">Region:</p>
                    @switch($buy->region)
                    @case(0)
                    PK Range<br>
                    @break
                    @case(1)
                    TKE<br>
                    @break
                    @case(2)
                    PF<br>
                    @break
                    @case(3)
                    Oasa<br>
                    @endswitch
                    <br>
                    <p class="font-medium">Type:</p>
                    @switch($buy->type)
                    @case(0)
                    All capital escalations<br><br>
                    @break
                    @case(1)
                    Infested Starbase<br><br>
                    @break
                    @case(2)
                    Capital Hive<br><br>
                    @break
                    @case(3)
                    Germinating Drone Enclave<br><br>
                    @break
                    @case(4)
                    Outgrowth Rogue Drone Hive (5/10)<br><br>
                    @break
                    @case(5)
                    Outgrowth Rogue Drone Hive (10/10)<br><br>
                    @break
                    @case(6)
                    Shrouded Asteroid Belt<br><br>
                    @break
                    @case(7)
                    Drone Infested Mine<br><br>
                    @endswitch
                    <p class="font-medium">Order Length:</p>
                    @switch($buy->length)
                    @case(0)
                    Twenty four hours<br><br>
                    @endswitch
                    <p class="font-medium">Max number of escalations: </p>
                    @if($buy->user_id == $user)
                    <input type="hidden" name="_method" value="edit" />
                    <form action="{{ route('buy.edit') }}" method="POST">
                        <input name="id" type="hidden" value="{{$buy->id}}">
                        <input type="number" id="quantity" name="quantity" min="1" max="99" placeholder={{number_format($buy->quantity)}} class="bg-gray-100 border-2 rounded-lg">
                        <input class="text-white bg-blue-700 hover:bg-blue-800 
                        focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 
                        dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit" value="edit" />
                        @method('put')
                        @csrf
                    </form>
                    @else
                        {{$buy->quantity}}<br><br>
                    @endif
                    <p class="font-medium">Price:</p>{{ number_format($buy->price) }}
                    <br>
                    <br>
                    @if($buy->user_id == $user)
                    <input type="hidden" name="_method" value="delete" />
                    <form action="{{ route('buy.destroy',$buy->id) }}" method="post">
                        <input class="text-white bg-blue-700 hover:bg-blue-800 
                        focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 
                        dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit" value="Delete" />
                        @method('delete')
                        @csrf
                    </form>
                    @endif
                    <br>
                    </div>
                </div>
                <br>
                <br>
                @endforeach
        </div>
    </div>
@endsection