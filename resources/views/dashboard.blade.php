@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Tableau de bord</h1>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Total Contacts Card -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Contacts</dt>
                            <dd class="text-3xl font-semibold text-gray-900">{{ $totalContacts }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-3">
                <a href="{{ route('contacts.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                    Voir tous les contacts →
                </a>
            </div>
        </div>

        <!-- Total Groups Card -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Groupes</dt>
                            <dd class="text-3xl font-semibold text-gray-900">{{ $totalGroups }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-3">
                <a href="{{ route('groups.index') }}" class="text-sm font-medium text-green-600 hover:text-green-500">
                    Voir tous les groupes →
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Contacts -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Contacts récents</h2>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($recentContacts as $contact)
                <div class="px-6 py-4 hover:bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="text-sm font-medium text-gray-900">{{ $contact->full_name }}</h3>
                            <div class="mt-1 flex items-center space-x-4 text-sm text-gray-500">
                                @if($contact->email)
                                    <span>📧 {{ $contact->email }}</span>
                                @endif
                                @if($contact->phone)
                                    <span>📱 {{ $contact->phone }}</span>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('contacts.show', $contact->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Voir →
                        </a>
                    </div>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-gray-500">
                    Aucun contact pour le moment.
                    <a href="{{ route('contacts.create') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        Créer votre premier contact
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Groups Overview -->
    <div class="bg-white shadow-sm rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Vos groupes</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @forelse($groups as $group)
                    <a href="{{ route('groups.show', $group->id) }}" class="block p-4 border border-gray-200 rounded-lg hover:border-blue-500 hover:shadow-md transition">
                        <h3 class="font-medium text-gray-900">{{ $group->name }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $group->contacts_count }} contact(s)</p>
                    </a>
                @empty
                    <div class="col-span-3 text-center text-gray-500 py-4">
                        Aucun groupe créé.
                        <a href="{{ route('groups.create') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Créer un groupe
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
