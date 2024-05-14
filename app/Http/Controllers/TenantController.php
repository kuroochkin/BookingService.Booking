<?php

namespace App\Http\Controllers;

use App\Services\TenantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TenantController extends BaseController
{
    public function __construct(private readonly TenantService $tenantService)
    {
    }

    public function getById(Request $request): JsonResponse
    {
        $result = $this->tenantService->getById($request);

        if (!$result) {
            return response()->json(['error' => 'Ошибка получения жильца.'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return response()->json($result->toJson())->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
