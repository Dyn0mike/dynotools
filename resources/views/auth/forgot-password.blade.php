<!--The view that is returned by this route should have a form containing an 'email' field,
     which will allow the user to request a password reset link for a given email address.-->

@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
    <div class="w-4/12 bg-white p-6 rounded-lg">
        @if (session('status'))
        {{session('status')}}
        @endif


    <form action="{{ route('password.email')}}" method="post">
        @csrf
        <div class="mb-4">
            <label for="email" class="sr-only">Email</label>
            <input type="text" name="email" id="email" placeholder="Your Email"
            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">

            @error('email')
            <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
            </div>
        @enderror
        </div> 

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded
            font-medium w-full">Login</button>
        </div>
    </form>
</div>
</div>

@endsection