@extends('layouts.app')

@section('title', 'Détails du Groupe')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('groups.index') }}" class="text-blue-600 hover:text-blue-800">
            ← Retour aux groupes
        </a>
    </div>

    <!-- Group Header -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">
        <div class="px-6 py-4 bg-gradient-to-r from-green-500 to-green-600 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold">{{ $group->name }}</h1>
                    @if($group->description)
                        <p class="mt-2 text-green-100">{{ $group->description }}</p>
                    @endif
                    <p class="mt-2 text-sm text-green-100">{{ $contacts->count() }} contact(s) dans ce groupe</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('groups.edit', $group->id) }}" class="px-4 py-2 bg-white text-green-600 rounded-md hover:bg-green-50">
                        Modifier
                    </a>
                    <form action="{{ route('groups.destroy', $group->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce groupe ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Contacts in Group -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Contacts du groupe</h2>
        </div>

        @if($contacts->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach($contacts as $contact)
                    <div class="px-6 py-4 hover:bg-gray-50 flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="text-sm font-medium text-gray-900">{{ $contact->full_name }}</h3>
                            <div class="mt-1 flex items-center space-x-4 text-sm text-gray-500">
                                @if($contact->email)
                                    <span>📧 {{ $contact->email }}</span>
                                @endif
                                @if($contact->phone)
                                    <span>📱 {{ $contact->phone }}</span>
                                @endif
                                @if($contact->company)
                                    <span>🏢 {{ $contact->company }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('contacts.show', $contact->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Voir
                            </a>
                            <a href="{{ route('contacts.edit', $contact->id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                Modifier
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="px-6 py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun contact</h3>
                <p class="mt-1 text-sm text-gray-500">Ce groupe ne contient aucun contact pour le moment.</p>
                <div class="mt-6">
                    <a href="{{ route('contacts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                        Ajouter un contact
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
