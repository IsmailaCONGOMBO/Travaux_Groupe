<?php

namespace App\Services;

use App\Models\Group;
use App\Repositories\Contracts\GroupRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class GroupService
{
    public function __construct(
        private GroupRepositoryInterface $groupRepository
    ) {}

    /**
     * Get all groups for a user.
     */
    public function getAllGroups(int $userId): Collection
    {
        return $this->groupRepository->getAllForUser($userId);
    }

    /**
     * Get groups with contact count.
     */
    public function getGroupsWithCount(int $userId): Collection
    {
        return $this->groupRepository->getWithContactCount($userId);
    }

    /**
     * Get a group by ID.
     */
    public function getGroup(int $id, int $userId): ?Group
    {
        return $this->groupRepository->findForUser($id, $userId);
    }

    /**
     * Create a new group.
     */
    public function createGroup(array $data, int $userId): Group
    {
        try {
            $data['user_id'] = $userId;
            $group = $this->groupRepository->create($data);

            Log::info('Group created', ['group_id' => $group->id, 'user_id' => $userId]);

            return $group;
        } catch (\Exception $e) {
            Log::error('Failed to create group', ['error' => $e->getMessage(), 'user_id' => $userId]);
            throw $e;
        }
    }

    /**
     * Update a group.
     */
    public function updateGroup(int $id, array $data, int $userId): ?Group
    {
        try {
            $group = $this->groupRepository->findForUser($id, $userId);
            
            if (!$group) {
                return null;
            }

            $this->groupRepository->update($group, $data);
            Log::info('Group updated', ['group_id' => $group->id, 'user_id' => $userId]);

            return $group->fresh();
        } catch (\Exception $e) {
            Log::error('Failed to update group', ['error' => $e->getMessage(), 'group_id' => $id]);
            throw $e;
        }
    }

    /**
     * Delete a group.
     */
    public function deleteGroup(int $id, int $userId): bool
    {
        try {
            $group = $this->groupRepository->findForUser($id, $userId);
            
            if (!$group) {
                return false;
            }

            $this->groupRepository->delete($group);
            Log::info('Group deleted', ['group_id' => $id, 'user_id' => $userId]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to delete group', ['error' => $e->getMessage(), 'group_id' => $id]);
            throw $e;
        }
    }
}
