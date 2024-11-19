@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <h1>Request this moon.</h1>
            
            <div class="m-auto">
                
                <span>
                     
                    Moon Id: {{$mReq->id}}<br>
                    Moon Worth: {{$mReq->MoonWorth}}<br>
                    Moon Rent: {{$mReq->Rent}}<br>

                </span>
                <form method="POST" action="{{ route('mReq', $mReq->id)}}">
                    @csrf
                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded
                        font-medium w-full">Request this moon.</button>
                    </div>
                </form>

                
            </div>
        </div>
    </div>
@endsection