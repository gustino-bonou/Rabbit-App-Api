<?php

namespace App\Models;

use App\Models\User;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;


class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}