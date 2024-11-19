@extends('layouts.app')

@section('content')
<div class="flex justify-center gap-4">

    <div class="gap-4 bg-white p-3 g-5 rounded-lg">
            @if (Session::has('message'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"><p> Please authenticate with a Eve Accout below.</div>
            @endif
        
        <div class="m-auto rounded">
            Login with your main Horde toon and ONLY your main.
            <a href="/auth/redirect"><img src="/eve-sso-login-black-large.png" alt="" height="100"></a>
            @foreach ($toons as $toon)

            <div class="rounded-md border-2">
                <!--Corp Name: <br>-->
                Name: {{$toon->character_name }}<br>
            </div>

            @endforeach
            {{$pub}}
        </div>
    </div>
    <div class="grid gap-4 bg-white p-4 rounded-lg">

        

        Moon Requests:
        
        @foreach ($reqs as $req)
        <div class="rounded-lg border-2 p-2">
            Request ID: {{$req->id}}<br>
            Moon: {{$req->moon->SystemMoon}}<br>
            
        </div>
        @endforeach
        
        
        

    </div>
    <div class="grid grid-cols-3 bg-white p-4 rounded-lg gap-4">

        Owned Moons:
        @php($rent = 0)
        @foreach ($Umoons as $Umoon)
        <div class="rounded-md border-2 gap-2">
            SystemMoon: {{$Umoon->SystemMoon}}<br>
            Rent: {{number_format($Umoon->Rent)}}
            @php($rent = $rent + $Umoon->Rent)
        </div>
        @endforeach
        <p class="bottom-1">Total Rent Owed:{{number_format($rent)}}</p>
    </div>
</div>
@endsection