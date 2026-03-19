<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use App\Services\GroupService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(
        private ContactService $contactService,
        private GroupService $groupService
    ) {}

    /**
     * Display the dashboard.
     */
    public function index()
    {
        $userId = Auth::id();
        
        $recentContacts = $this->contactService->getAllContacts($userId, 5);
        $groups = $this->groupService->getGroupsWithCount($userId);
        
        $totalContacts = $this->contactService->getAllContacts($userId, 1)->total();
        $totalGroups = $groups->count();

        return view('dashboard', compact('recentContacts', 'groups', 'totalContacts', 'totalGroups'));
    }
}
