@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
    <div class="w-4/12 bg-white p-6 rounded-lg">
    <form action="{{ route('buy')}}" method="post">
        @csrf
        <div class="mb-4">
            <label for="name" class="">Your toons name:</label>
            <input type="text" name="name" id="name" placeholder="Your toons name:"
            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ old('name') }}">

            @error('name')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
            @enderror
        </div>  
        <div class="mb-4">
            <label for="discord" class="">Your Discord ID:</label>
            <input type="text" name="discord" id="discord" placeholder="Your Discord ID:"
            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ old('discord') }}">

            @error('discord')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
            @enderror
        </div>  
        <div class="mb-4">
            <label for="region" class="">Region:</label>
            <select id="region" name="region">
                <option value="0">PK range</option>
                <option value="1">TKE</option>
                <option value="2">PF</option>
                <option value="3">Oasa</option>
              </select>

            @error('region')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
            @enderror
        </div>    
        <div class="mb-4">
            <label for="type" class="">Type:</label>
            <select id="type" name="type">
                <option value="0">All capital escalations</option>
                <option value="1">Infested Starbase</option>
                <option value="2">Capital Hive</option>
                <option value="3">Germinating Drone Enclave</option>
                <option value="4">Outgrowth Rogue Drone Hive (5/10)</option>
                <option value="5">Outgrowth Rogue Drone Hive (10/10)</option>
                <option value="6">Shrouded Asteroid Belt</option>
                <option value="7">Drone Infested Mine</option>
              </select>

            @error('type')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
            @enderror
        </div>  
        <div class="mb-4">
            <label for="length" class="">Order Length:</label>
            <select id="length" name="length">
                <option value="0">Twenty four hours</option>
              </select>

            @error('length')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
            @enderror
        </div>  
        <div class="mb-4">
            <label for="quantity" class="sr-only">Number of escalations</label>
            <input type="number" name="quantity" id="quantity" placeholder="Number of escalations"
            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('quantity') border-red-500 @enderror" value="{{ old('quantity') }}">

            @error('quantity')
            <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
            </div>
            @enderror
        </div> 
        <div class="mb-4">
            <label for="price" class="sr-only">Price per Escalation</label>
            <input type="number" name="price" id="price" placeholder="Price per escalation"
            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('price') border-red-500 @enderror" value="{{ old('price') }}">

            @error('price')
            <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
            </div>
            @enderror
        </div> 
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded
            font-medium w-full">Order</button>
        </div>
    </form>
</div>
</div>

@endsection