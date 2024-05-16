<?php

namespace App\Services;

use App\Models\Tenant;
use App\Repositories\TenantRepository;
use Illuminate\Http\Request;

final class TenantService
{
    public function __construct(private readonly TenantRepository $tenantRepository)
    {

    }

    public function getById(Request $request): ?Tenant
    {
        $tenantId = $request->input('tenant_id');

        return $this->tenantRepository->getById($tenantId);
    }
}
