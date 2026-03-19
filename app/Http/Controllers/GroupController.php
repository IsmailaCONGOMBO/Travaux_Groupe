<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Services\GroupService;
use App\Services\ContactService;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function __construct(
        private GroupService $groupService,
        private ContactService $contactService
    ) {}

    /**
     * Display a listing of the groups.
     */
    public function index()
    {
        $groups = $this->groupService->getGroupsWithCount(Auth::id());
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new group.
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created group in storage.
     */
    public function store(StoreGroupRequest $request)
    {
        try {
            $this->groupService->createGroup(
                $request->validated(),
                Auth::id()
            );

            return redirect()
                ->route('groups.index')
                ->with('success', 'Groupe créé avec succès.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la création du groupe.');
        }
    }

    /**
     * Display the specified group.
     */
    public function show(int $id)
    {
        $group = $this->groupService->getGroup($id, Auth::id());

        if (!$group) {
            abort(404);
        }

        $contacts = $this->contactService->getContactsByGroup($id, Auth::id());

        return view('groups.show', compact('group', 'contacts'));
    }

    /**
     * Show the form for editing the specified group.
     */
    public function edit(int $id)
    {
        $group = $this->groupService->getGroup($id, Auth::id());

        if (!$group) {
            abort(404);
        }

        return view('groups.edit', compact('group'));
    }

    /**
     * Update the specified group in storage.
     */
    public function update(UpdateGroupRequest $request, int $id)
    {
        try {
            $group = $this->groupService->updateGroup(
                $id,
                $request->validated(),
                Auth::id()
            );

            if (!$group) {
                abort(404);
            }

            return redirect()
                ->route('groups.index')
                ->with('success', 'Groupe mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour du groupe.');
        }
    }

    /**
     * Remove the specified group from storage.
     */
    public function destroy(int $id)
    {
        try {
            $deleted = $this->groupService->deleteGroup($id, Auth::id());

            if (!$deleted) {
                abort(404);
            }

            return redirect()
                ->route('groups.index')
                ->with('success', 'Groupe supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Erreur lors de la suppression du groupe.');
        }
    }
}
