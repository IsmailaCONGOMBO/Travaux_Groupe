<?php

namespace App\Services;

use App\Models\Contact;
use App\Repositories\Contracts\ContactRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactService
{
    public function __construct(
        private ContactRepositoryInterface $contactRepository
    ) {}

    /**
     * Get all contacts for a user.
     */
    public function getAllContacts(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->contactRepository->getAllForUser($userId, $perPage);
    }

    /**
     * Get a contact by ID.
     */
    public function getContact(int $id, int $userId): ?Contact
    {
        return $this->contactRepository->findForUser($id, $userId);
    }

    /**
     * Create a new contact with validation.
     */
    public function createContact(array $data, int $userId): Contact
    {
        try {
            DB::beginTransaction();

            $data['user_id'] = $userId;
            $contact = $this->contactRepository->create($data);

            // Attach groups if provided
            if (isset($data['groups']) && is_array($data['groups'])) {
                $this->contactRepository->attachGroups($contact, $data['groups']);
            }

            DB::commit();
            Log::info('Contact created', ['contact_id' => $contact->id, 'user_id' => $userId]);

            return $contact->load('groups');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create contact', ['error' => $e->getMessage(), 'user_id' => $userId]);
            throw $e;
        }
    }

    /**
     * Update a contact.
     */
    public function updateContact(int $id, array $data, int $userId): ?Contact
    {
        try {
            DB::beginTransaction();

            $contact = $this->contactRepository->findForUser($id, $userId);
            
            if (!$contact) {
                return null;
            }

            $this->contactRepository->update($contact, $data);

            // Sync groups if provided
            if (isset($data['groups']) && is_array($data['groups'])) {
                $this->contactRepository->syncGroups($contact, $data['groups']);
            }

            DB::commit();
            Log::info('Contact updated', ['contact_id' => $contact->id, 'user_id' => $userId]);

            return $contact->fresh('groups');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update contact', ['error' => $e->getMessage(), 'contact_id' => $id]);
            throw $e;
        }
    }

    /**
     * Delete a contact.
     */
    public function deleteContact(int $id, int $userId): bool
    {
        try {
            $contact = $this->contactRepository->findForUser($id, $userId);
            
            if (!$contact) {
                return false;
            }

            $this->contactRepository->delete($contact);
            Log::info('Contact deleted', ['contact_id' => $id, 'user_id' => $userId]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to delete contact', ['error' => $e->getMessage(), 'contact_id' => $id]);
            throw $e;
        }
    }

    /**
     * Search contacts.
     */
    public function searchContacts(string $query, int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->contactRepository->search($userId, $query, $perPage);
    }

    /**
     * Get contacts by group.
     */
    public function getContactsByGroup(int $groupId, int $userId): Collection
    {
        return $this->contactRepository->getByGroup($groupId, $userId);
    }
}
