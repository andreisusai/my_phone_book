@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-24">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        <div class="flex justify-center">
            <div class="w-6/12 bg-white p-6 rounded-lg">
                <form action="{{ route('entreprises.create') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="sr-only">Nom entreprise</label>
                        <input type="text" name="name" id="name" placeholder="Nom de l'entreprise" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('name') border-red-500 @enderror" value="{{ old('name') }}">

                        @error('name')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="street" class="sr-only">Rue</label>
                        <input type="text" name="street" id="street" placeholder="Nom de la rue" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('street') border-red-500 @enderror" value="{{ old('street') }}">

                        @error('street')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="zip_code" class="sr-only">Code postal</label>
                        <input type="text" name="zip_code" id="zip_code" placeholder="Code postal" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('zip_code') border-red-500 @enderror" value="{{ old('zip_code') }}">

                        @error('zip_code')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="city" class="sr-only">Ville</label>
                        <input type="text" name="city" id="city" placeholder="Nom de la ville" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('city') border-red-500 @enderror" value="{{ old('city') }}">

                        @error('city')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="sr-only">Numéro de téléphone</label>
                        <input type="text" name="phone" id="phone" placeholder="Votre numéro de téléphone" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('phone') border-red-500 @enderror" value="{{ old('phone') }}">

                        @error('phone')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="sr-only">Email</label>
                        <input type="text" name="email" id="email" placeholder="Votre email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">

                        @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection