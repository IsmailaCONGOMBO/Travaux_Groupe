@extends('layouts.app')

@section('title', 'Groupes')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Mes Groupes</h1>
        <a href="{{ route('groups.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
            + Nouveau Groupe
        </a>
    </div>

    <!-- Groups Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($groups as $group)
            <div class="bg-white shadow-sm rounded-lg overflow-hidden hover:shadow-md transition">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $group->name }}</h3>
                            @if($group->description)
                                <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $group->description }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 flex items-center text-sm text-gray-500">
                        <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        {{ $group->contacts_count }} contact(s)
                    </div>
                </div>

                <div class="px-6 py-3 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                    <a href="{{ route('groups.show', $group->id) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                        Voir détails →
                    </a>
                    <div class="flex space-x-2">
                        <a href="{{ route('groups.edit', $group->id) }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                            Modifier
                        </a>
                        <form action="{{ route('groups.destroy', $group->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce groupe ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white shadow-sm rounded-lg p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun groupe</h3>
                <p class="mt-1 text-sm text-gray-500">Commencez par créer un nouveau groupe.</p>
                <div class="mt-6">
                    <a href="{{ route('groups.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                        + Créer un groupe
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
