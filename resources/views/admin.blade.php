@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            Admin
            <form action="{{route('admin.reprice')}}" method="post">
                @csrf
                <button type="submit" class=" text-red-700 hover:text-white border border-red-700 hover:bg-red-800">Reprice</button>
            </form>
            
        </div>
    </div>
@endsection