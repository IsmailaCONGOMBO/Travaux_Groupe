<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Group;

class EnsureGroupOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $groupId = $request->route('group');
        
        if ($groupId) {
            $group = Group::find($groupId);
            
            if (!$group || $group->user_id !== $request->user()->id) {
                abort(403, 'Accès non autorisé à ce groupe.');
            }
        }
        
        return $next($request);
    }
}
