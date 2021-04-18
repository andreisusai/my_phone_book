@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-24">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        @if (session('status'))
        <div class="bg-green-500 p-4 rounded-lg mb-6 text-white text-center">
            {{ session('status') }}
        </div>
        @endif
        @if(auth()->user())
        Annuaire des entreprises et des collaborateurs
        @else
        Veulliez vous connecté ...
        @endif
    </div>
</div>
@endsection