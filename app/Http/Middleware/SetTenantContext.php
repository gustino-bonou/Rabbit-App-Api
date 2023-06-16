<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetTenantContext
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Récupérer l'utilisateur authentifié
        /* $userId = auth()->user()->id;
        $user = User::find($userId);

        // Récupérer l'ID du tenant associé à l'utilisateur
        $tenantId = $user->tenant();

        // Basculer automatiquement le contexte du tenant
        app(TenantManager::class)->initialize($tenantId); */

        
        return $next($request);
    }
}
