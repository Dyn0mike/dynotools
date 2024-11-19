@extends('layouts.app')

@section('content')
    
<!-- This is a comment 

<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
@foreach($moonst as $moons)
<div class="mb-4">
<p class="mb-2">{{ $moons->id}}</p>
<p class="mb-2">{{ $moons->SystemMoon}}</p>
@endforeach
{{$moonst->onEachSide(1)->links()}}
</div>
</div>-->

<Form class="w-px-500 p-3 p-md-3" action="{{route('moons.filterMoons')}}" method="post">
  @csrf
  <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Moon Filters</label>
    <div class="col-sm-9">
      <input type="radio" name="moon" value="TKEPF16"> TKE/PF R16
      <input type="radio" name="moon" value="TKEPF8"> TKE/PF R8/R4
      <input type="radio" name="moon" value="im64"> IM R64/R32
      <input type="radio" name="moon" value="im16"> im R16
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-3 col-form-label"></label>
    <div class="col-sm-9">
      <button type="submit" class="btn btn-success btn-block">Filter</button>
    </div>
  </div>

</Form>
<div class="container mx-auto">
    <div class="flex flex-wrap -mx-4">
        @foreach($moonst as $moons)
<div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 p-4">
    <a href="{{ URL::to('mReq/'.$moons->id) }}" class="c-card block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
    <div class="relative pb-4 overflow-hidden">
      <!--<img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1475855581690-80accde3ae2b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=750&q=80" alt="">
      -->
    </div>
    <div class="p-4">
      <span class="inline-block px-2 py-1 leading-none bg-orange-200 text-orange-800 rounded-full font-semibold uppercase tracking-wide text-xs">{{ $moons->MoonWorth}}</span>
      <h2 class="mt-2 mb-2  font-bold">{{ $moons->SystemMoon}}</h2>
      <p class="text-sm">{{ $moons->Ore1}} {{ $moons->p1}}<br>
        {{ $moons->Ore2}} {{ $moons->p2}}<br>
        {{ $moons->Ore3}} {{ $moons->p3}}<br>
        {{ $moons->Ore4}} {{ $moons->p4}}<br>
    </p>
      <div class="mt-3 flex items-center">
        <!--<span class="text-sm font-semibold">ab</span>-->
        &nbsp;<span class="font-bold text-xl">{{ number_format($moons->Rent)}}</span>&nbsp;<span class="text-sm font-semibold">ISK/pm</span>
      </div>
    </div>
    <div class="p-4 border-t border-b text-xs text-gray-700">
      <span class="flex items-center mb-1">
        <i class="far fa-clock fa-fw mr-2 text-gray-900"></i> Avilable: {{ $moons->Available}}
      </span>
      <!--<span class="flex items-center">
        <i class="far fa-address-card fa-fw text-gray-900 mr-2"></i> Ermäßigung mit Karte
      </span>    -->    
    </div>
    <!--<div class="p-4 flex items-center text-sm text-gray-600"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-yellow-500"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-yellow-500"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-yellow-500"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-yellow-500"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 fill-current text-gray-400"><path d="M8.128 19.825a1.586 1.586 0 0 1-1.643-.117 1.543 1.543 0 0 1-.53-.662 1.515 1.515 0 0 1-.096-.837l.736-4.247-3.13-3a1.514 1.514 0 0 1-.39-1.569c.09-.271.254-.513.475-.698.22-.185.49-.306.776-.35L8.66 7.73l1.925-3.862c.128-.26.328-.48.577-.633a1.584 1.584 0 0 1 1.662 0c.25.153.45.373.577.633l1.925 3.847 4.334.615c.29.042.562.162.785.348.224.186.39.43.48.704a1.514 1.514 0 0 1-.404 1.58l-3.13 3 .736 4.247c.047.282.014.572-.096.837-.111.265-.294.494-.53.662a1.582 1.582 0 0 1-1.643.117l-3.865-2-3.865 2z"></path></svg><span class="ml-2">34 Bewertungen</span></div>

    -->
    </a>
  </div>
  
  @endforeach
  
</div>
{{$moonst->onEachSide(1)->links()}}
</div>


@endsection