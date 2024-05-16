<?php

namespace App\Repositories;

use App\Models\Tenant;

final class TenantRepository
{
    public function getById(int $id): ?Tenant
    {
        $result = Tenant::find($id);

        return $result ? $result : null;
    }
}
