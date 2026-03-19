<?php

namespace App\Repositories\Contracts;

use App\Models\Group;
use Illuminate\Database\Eloquent\Collection;

interface GroupRepositoryInterface
{
    /**
     * Get all groups for a user.
     */
    public function getAllForUser(int $userId): Collection;

    /**
     * Find a group by ID for a specific user.
     */
    public function findForUser(int $id, int $userId): ?Group;

    /**
     * Create a new group.
     */
    public function create(array $data): Group;

    /**
     * Update a group.
     */
    public function update(Group $group, array $data): bool;

    /**
     * Delete a group.
     */
    public function delete(Group $group): bool;

    /**
     * Get groups with contact count.
     */
    public function getWithContactCount(int $userId): Collection;
}
