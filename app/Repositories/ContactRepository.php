<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\Contracts\ContactRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ContactRepository implements ContactRepositoryInterface
{
    /**
     * Get all contacts for a user with optional pagination.
     */
    public function getAllForUser(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return Contact::forUser($userId)
            ->with('groups')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate($perPage);
    }

    /**
     * Find a contact by ID for a specific user.
     */
    public function findForUser(int $id, int $userId): ?Contact
    {
        return Contact::forUser($userId)
            ->with('groups')
            ->find($id);
    }

    /**
     * Create a new contact.
     */
    public function create(array $data): Contact
    {
        return Contact::create($data);
    }

    /**
     * Update a contact.
     */
    public function update(Contact $contact, array $data): bool
    {
        return $contact->update($data);
    }

    /**
     * Delete a contact.
     */
    public function delete(Contact $contact): bool
    {
        return $contact->delete();
    }

    /**
     * Search contacts for a user.
     */
    public function search(int $userId, string $query, int $perPage = 15): LengthAwarePaginator
    {
        return Contact::forUser($userId)
            ->search($query)
            ->with('groups')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate($perPage);
    }

    /**
     * Get contacts by group.
     */
    public function getByGroup(int $groupId, int $userId): Collection
    {
        return Contact::forUser($userId)
            ->whereHas('groups', function ($query) use ($groupId) {
                $query->where('groups.id', $groupId);
            })
            ->with('groups')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();
    }

    /**
     * Attach groups to a contact.
     */
    public function attachGroups(Contact $contact, array $groupIds): void
    {
        $contact->groups()->attach($groupIds);
    }

    /**
     * Sync groups for a contact.
     */
    public function syncGroups(Contact $contact, array $groupIds): void
    {
        $contact->groups()->sync($groupIds);
    }
}
