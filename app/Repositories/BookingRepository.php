<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

final class BookingRepository
{
    public function create(Request $request): ?Booking
    {
        $result = Booking::create($request->only((new Booking())->getFillable()));

        return $result ? $result : null;
    }

    public function getItemsByAccommodationId(int $accommodationId): ?Collection
    {
        $result = Booking::where('accommodation_id', '=', $accommodationId)->get();

        return $result ? $result : null;
    }

    public function getByAccommodationIdAndTenantId(int $accommodationId, int $tenantId): ?Booking
    {
        $result = Booking::where('accommodation_id', '=', $accommodationId)
            ->where('tenant_id', '=', $tenantId)->get()->last();

        return $result ? $result : null;
    }

    public function update(Booking $booking, Request $request): ?Booking
    {
        $result = $booking->update($request->only('booking_status'));

        return $result ? $booking : null;
    }

    public function delete(Booking $booking): bool
    {
        return $booking->delete();
    }

    public function getBookingByTenantAndAccommodationId(int $tenantId, int $accommodationId): Booking
    {
        return Booking::where('tenant_id', '=', $tenantId)
            ->where('accommodation_id', '=', $accommodationId)->first();
    }
}
