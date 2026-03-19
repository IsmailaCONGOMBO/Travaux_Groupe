<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Contact;

class EnsureContactOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $contactId = $request->route('contact');
        
        if ($contactId) {
            $contact = Contact::find($contactId);
            
            if (!$contact || $contact->user_id !== $request->user()->id) {
                abort(403, 'Accès non autorisé à ce contact.');
            }
        }
        
        return $next($request);
    }
}
