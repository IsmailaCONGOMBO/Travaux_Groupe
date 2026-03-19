<?php

namespace App\Repositories;

use App\Models\Group;
use App\Repositories\Contracts\GroupRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GroupRepository implements GroupRepositoryInterface
{
    /**
     * Get all groups for a user.
     */
    public function getAllForUser(int $userId): Collection
    {
        return Group::forUser($userId)
            ->orderBy('name')
            ->get();
    }

    /**
     * Find a group by ID for a specific user.
     */
    public function findForUser(int $id, int $userId): ?Group
    {
        return Group::forUser($userId)->find($id);
    }

    /**
     * Create a new group.
     */
    public function create(array $data): Group
    {
        return Group::create($data);
    }

    /**
     * Update a group.
     */
    public function update(Group $group, array $data): bool
    {
        return $group->update($data);
    }

    /**
     * Delete a group.
     */
    public function delete(Group $group): bool
    {
        return $group->delete();
    }

    /**
     * Get groups with contact count.
     */
    public function getWithContactCount(int $userId): Collection
    {
        return Group::forUser($userId)
            ->withCount('contacts')
            ->orderBy('name')
            ->get();
    }
}
