@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-24">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        @if($companies->count())
        @foreach($companies as $company)
        <p>Nom de l'entreprise</p>
        <h2 class="mb-4 ml-6 color-green">{{ $company->name }}</h2>
        <p>Adresse</p>
        <address class="ml-6">
            <p>{{ $company->street }}</p>
            <p>{{ $company->zip_code }}</p>
            <p>{{ $company->city }}</p>
        </address>
        <p class="mt-4">Téléphone: <a href="tel:{{ $company->phone }}">{{ $company->phone }}</a></p>
        <p class="mt-4">Email: <a href="mailto:{{ $company->email }}">{{ $company->email }}</a></p>
        @endforeach
        @else
        <p>Il n'y pas d'entreprise avec cet id...</p>
        @endif
    </div>
</div>
@endsection