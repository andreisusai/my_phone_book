@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-24">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        @if($contributors->count())
        @foreach($contributors as $contributor)
        <h1>Collaborateur</h1>
        <h2 class="mb-4 ml-6">
            {{ ($contributor->civility === "male") ? 'M. ' : ''}}
            {{ ($contributor->civility === "female") ? 'Mme. ' : ''}}
            {{ ($contributor->civility === "non_binaire") ? 'Civilité non binaire ' : ''}}
            {{ $contributor->last_name }} {{ $contributor->first_name }}</h2>
        <p>Adresse</p>
        <address class="ml-6">
            <p>{{ $contributor->street }}</p>
            <p>{{ $contributor->zip_code }}</p>
            <p>{{ $contributor->city }}</p>
        </address>
        <p class="mt-4">Téléphone: <a href="tel:{{ $contributor->phone }}">{{ $contributor->phone }}</a></p>
        <p class="mt-4">Email: <a href="mailto:{{ $contributor->email }}">{{ $contributor->email }}</a></p>
        <h2 class="mt-6">Entreprise</h2>
        <p class="mb-4 ml-6">{{ $contributor->name }}</p>
        <p class="mb-4 ml-6">Téléphone: <a href="tel:{{ $contributor->company_phone }}">{{ $contributor->phone }}</a></p>
        @endforeach
        @else
        <p>Il n'y pas de collaborateur avec cet id...</p>
        @endif
    </div>
</div>
@endsection