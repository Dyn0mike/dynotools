<!--form containing an email field, a password field, a password_confirmation field, and a hidden token field-->

@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
    <div class="w-4/12 bg-white p-6 rounded-lg">
    <form action="{{ route('password.update')}}" method="post">
        @csrf 
        <input type="hidden" name="token" value="{{ $token }}">  
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
        <div class="mb-4">
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" placeholder="Your Password"
            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" value="">

            @error('password')
            <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
            </div>
        @enderror
        </div> 
        <div class="mb-4">
            <label for="password_confirmation" class="sr-only">Password again</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your Password"
            class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password_confirmation') border-red-500 @enderror" value="">


            @error('password_confirmation')
            <div class="text-red-500 mt-2 text-sm">
                {{ $message }}
            </div>
        @enderror
        </div> 

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded
            font-medium w-full">Reset Password</button>
        </div>
    </form>
</div>
</div>

@endsection