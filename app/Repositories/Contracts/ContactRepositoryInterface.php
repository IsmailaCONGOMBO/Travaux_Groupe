<?php

namespace App\Repositories\Contracts;

use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ContactRepositoryInterface
{
    /**
     * Get all contacts for a user with optional pagination.
     */
    public function getAllForUser(int $userId, int $perPage = 15): LengthAwarePaginator;

    /**
     * Find a contact by ID for a specific user.
     */
    public function findForUser(int $id, int $userId): ?Contact;

    /**
     * Create a new contact.
     */
    public function create(array $data): Contact;

    /**
     * Update a contact.
     */
    public function update(Contact $contact, array $data): bool;

    /**
     * Delete a contact.
     */
    public function delete(Contact $contact): bool;

    /**
     * Search contacts for a user.
     */
    public function search(int $userId, string $query, int $perPage = 15): LengthAwarePaginator;

    /**
     * Get contacts by group.
     */
    public function getByGroup(int $groupId, int $userId): Collection;

    /**
     * Attach groups to a contact.
     */
    public function attachGroups(Contact $contact, array $groupIds): void;

    /**
     * Sync groups for a contact.
     */
    public function syncGroups(Contact $contact, array $groupIds): void;
}
