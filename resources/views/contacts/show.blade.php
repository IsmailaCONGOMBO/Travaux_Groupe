@extends('layouts.app')

@section('title', 'Détails du Contact')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('contacts.index') }}" class="text-blue-600 hover:text-blue-800">
            ← Retour aux contacts
        </a>
    </div>

    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold">{{ $contact->full_name }}</h1>
                    @if($contact->company)
                        <p class="mt-1 text-blue-100">{{ $contact->company }}</p>
                    @endif
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('contacts.edit', $contact->id) }}" class="px-4 py-2 bg-white text-blue-600 rounded-md hover:bg-blue-50">
                        Modifier
                    </a>
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Email -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Email</h3>
                    <p class="mt-2 text-lg text-gray-900">
                        @if($contact->email)
                            <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:text-blue-800">
                                {{ $contact->email }}
                            </a>
                        @else
                            <span class="text-gray-400">Non renseigné</span>
                        @endif
                    </p>
                </div>

                <!-- Phone -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Téléphone</h3>
                    <p class="mt-2 text-lg text-gray-900">
                        @if($contact->phone)
                            <a href="tel:{{ $contact->phone }}" class="text-blue-600 hover:text-blue-800">
                                {{ $contact->phone }}
                            </a>
                        @else
                            <span class="text-gray-400">Non renseigné</span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- Address -->
            @if($contact->address)
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Adresse</h3>
                    <p class="mt-2 text-gray-900 whitespace-pre-line">{{ $contact->address }}</p>
                </div>
            @endif

            <!-- Notes -->
            @if($contact->notes)
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Notes</h3>
                    <p class="mt-2 text-gray-900 whitespace-pre-line">{{ $contact->notes }}</p>
                </div>
            @endif

            <!-- Groups -->
            <div>
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-3">Groupes</h3>
                @if($contact->groups->count() > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach($contact->groups as $group)
                            <a href="{{ route('groups.show', $group->id) }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 hover:bg-blue-200">
                                {{ $group->name }}
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-400">Aucun groupe</p>
                @endif
            </div>

            <!-- Metadata -->
            <div class="pt-6 border-t border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-500">
                    <div>
                        <span class="font-medium">Créé le:</span> {{ $contact->created_at->format('d/m/Y à H:i') }}
                    </div>
                    <div>
                        <span class="font-medium">Modifié le:</span> {{ $contact->updated_at->format('d/m/Y à H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
