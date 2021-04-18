@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-24">
    <div class="w-10/12 bg-white p-6 rounded-lg">
        @if(auth()->user()->role !== "user")
        <a href="{{ route('collaborateurs.create') }}" class="p-3 bg-green-600 text-white text-center rounded-lg">Ajouter un collaborateur</a>
        <div class="mb-6"></div>
        @endif
        @if($contributors->count())
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="w-1/4 ...">Nom</th>
                    <th class="w-1/4 ...">Prénom</th>
                    <th class="w-1/4 ...">Téléphone</th>
                    <th class="w-1/4 ...">Email</th>
                    <th class="w-1/4 ... p-3">Entreprise</th>
                    <th class="w-1/4 ... p-3">Numéro entreprise</th>
                    @if(auth()->user()->role !== "user")
                    <th class="w-1/4 ... p-3">Éditer</th>
                    @endif
                    @if(auth()->user()->role === "admin")
                    <th class="w-1/4 ... p-3">Supprimer</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($contributors as $contributor)
                <tr>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center"><a href="{{ route('collaborateur.show', $contributor->id) }}">{{ $contributor->last_name }}</a></td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">{{ $contributor->first_name }}</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">{{ $contributor->phone }}</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">{{ $contributor->email }}</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">{{ $contributor->name }}</td>
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">{{ $contributor->company_phone }}</td>
                    @if(auth()->user()->role !== "user")
                    <td class="border-solid border-2 p-3 border-gray-500 text-center"><a href="{{ route('collaborateur.update', $contributor->id) }}" class="bg-blue-600 p-3 rounded-lg text-white">éditer</a></td>
                    @endif
                    @if(auth()->user()->role === "admin")
                    <td class="border-solid border-2 p-3 border-gray-500 text-center">
                        <form action="{{ route('collaborateur.destroy', $contributor->id) }}" method="post">
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
            {{ $contributors->links() }}
        </div>
        @else
        <p>Il n'y a pas de collaborateur enregistré</p>
        @endif
    </div>
</div>
<x-contributor-search />
@endsection