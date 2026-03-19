<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Services\ContactService;
use App\Services\GroupService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function __construct(
        private ContactService $contactService,
        private GroupService $groupService
    ) {}

    /**
     * Display a listing of the contacts.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $search = $request->get('search');

        if ($search) {
            $contacts = $this->contactService->searchContacts($search, $userId);
        } else {
            $contacts = $this->contactService->getAllContacts($userId);
        }

        return view('contacts.index', compact('contacts', 'search'));
    }

    /**
     * Show the form for creating a new contact.
     */
    public function create()
    {
        $groups = $this->groupService->getAllGroups(Auth::id());
        return view('contacts.create', compact('groups'));
    }

    /**
     * Store a newly created contact in storage.
     */
    public function store(StoreContactRequest $request)
    {
        try {
            $this->contactService->createContact(
                $request->validated(),
                Auth::id()
            );

            return redirect()
                ->route('contacts.index')
                ->with('success', 'Contact créé avec succès.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création du contact.');
        }
    }

    /**
     * Display the specified contact.
     */
    public function show(int $id)
    {
        $contact = $this->contactService->getContact($id, Auth::id());

        if (!$contact) {
            abort(404);
        }

        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified contact.
     */
    public function edit(int $id)
    {
        $contact = $this->contactService->getContact($id, Auth::id());

        if (!$contact) {
            abort(404);
        }

        $groups = $this->groupService->getAllGroups(Auth::id());
        
        return view('contacts.edit', compact('contact', 'groups'));
    }

    /**
     * Update the specified contact in storage.
     */
    public function update(UpdateContactRequest $request, int $id)
    {
        try {
            $contact = $this->contactService->updateContact(
                $id,
                $request->validated(),
                Auth::id()
            );

            if (!$contact) {
                abort(404);
            }

            return redirect()
                ->route('contacts.index')
                ->with('success', 'Contact mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour du contact.');
        }
    }

    /**
     * Remove the specified contact from storage.
     */
    public function destroy(int $id)
    {
        try {
            $deleted = $this->contactService->deleteContact($id, Auth::id());

            if (!$deleted) {
                abort(404);
            }

            return redirect()
                ->route('contacts.index')
                ->with('success', 'Contact supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la suppression du contact.');
        }
    }
}
