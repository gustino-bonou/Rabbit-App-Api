<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Stancl\Tenancy\Facades\Tenancy;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class InitializeTenantByUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function resolveTenant(Request $request): ?Tenant
    {
        // Récupérer l'utilisateur authentifié

        $user = Auth::user();


        if ($user) {
            // Utiliser l'utilisateur pour identifier le locataire
            // par exemple, en utilisant une colonne "tenant_id" dans la table des utilisateurs
            $tenantId = $user->tenant_id;

            // Récupérer le locataire correspondant à l'ID
            $tenant = Tenant::query()->where('id', $tenantId)->first();

            return $tenant;
        }

        return null;
    }
    public function handle(Request $request, Closure $next): Response
    {
        
        $tenant = $this->resolveTenant($request);
        

        if ($tenant !== null) {

            

            try {
                Tenancy::initialize($tenant);
            }
            catch (\Exception $e) {
                throw new HttpResponseException(response()->json([
                "error" => $e->getMessage(),

                ], 422));
            }
        }

        

        return $next($request); 
    }
}
