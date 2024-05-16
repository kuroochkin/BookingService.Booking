<?php

namespace App\Rules;

use App\Models\Booking;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AccommodationAndTenantAreUniques implements ValidationRule
{
    public function __construct(
        private readonly int $tenantId,
        private readonly int $accommodationId,
    ) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $count = Booking::where('tenant_id', '=', $this->tenantId)
            ->where('accommodation_id', '=', $this->accommodationId)
            ->count();

        if ($count !== 0) {
            dd('Вы уже подали заявку на бронирование этой комнаты, пожалуйста, выберите другую.');
        }
    }
}
