<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;

class ExcludeTenancyMiddleware extends InitializeTenancyByRequestData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Liste des noms de route à exclure du middleware InitializeTenancyByRequestData
        $excludedUrls = [
            '/api/register', // Ajoutez ici d'autres noms de routes que vous souhaitez exclure
        ];

        if (in_array($request->getRequestUri(), $excludedUrls)) {

            return $next($request);
        }

        return parent::handle($request, $next);
    }
}
