<?php

namespace App\Http\Middleware;

use Closure;
use URL as GlobalURL;
use App\Models\Tenant;
use PharIo\Manifest\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\Facades\Tenancy;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL as FacadesURL;

class HandleTenancy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasHeader('Authorization')) {
            
            $token = str_replace('Bearer ', '', $request->header('Authorization'));

            // Récupérer l'utilisateur associé au token Sanctum
            $user = \App\Models\User::where('authToken', "18|$token")->first();


            if ($user) {
                // Récupérer les informations du tenant associé à l'utilisateur (vous devez remplacer ceci par votre propre logique pour récupérer les informations du tenant)
                $tenant_id = $user->tenant_id; // Méthode fictive pour récupérer les informations du tenant

                $tenant = Tenant::find($tenant_id);

                // Initialiser le tenant avec Tenancy en utilisant les informations du tenant
                Tenancy::initialize($tenant);
            }

        }

        return $next($request);
    }
}
