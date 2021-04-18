@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-24">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        @if(auth()->user()->role !== "user")
        <a href="{{ route('entreprises.create') }}" class="p-3 bg-green-600 text-white text-center rounded-lg">Ajouter une entreprise</a>
        <div class="mb-6"></div>
        @endif

        @if($companies->count())
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="w-1/4 ...">Nom</th>
                    <th class="w-1/4 ...">Téléphone</th>
                    <th class="w-1/4 ...">Email</th>
                    <th class="w-1/4 ...">Code postal</th>
                    @if(auth()->user()->role !== "user")
                    <th class="w-1/4 ...">Éditer</th>
                    @endif
                    @if(auth()->user()->role === "admin")
                    <th class="w-1/4 ...">Supprimer</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                <tr>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center"><a href="{{ route('entreprise.show', $company->id) }}">{{ $company->name }}</a></td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">{{ $company->phone }}</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">{{ $company->email }}</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">{{ $company->zip_code }}</td>
                    @if(auth()->user()->role !== "user")
                    <td class="border-solid border-2 p-3 border-gray-500 text-center"><a href="{{ route('entreprise.update', $company->id) }}" class="bg-blue-600 p-3 rounded-lg text-white">éditer</a></td>
                    @endif
                    @if(auth()->user()->role === "admin")
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">
                        <form action="{{ route('entreprise.destroy', $company->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 p-3 rounded-lg text-white">X</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-6">
            {{ $companies->links() }}
        </div>
        @else
        <p>Il n'y a pas d'entreprise enregistrée</p>
        @endif
    </div>
</div>
<x-search />

@endsection