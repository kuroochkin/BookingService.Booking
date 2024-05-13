<?php

namespace App\Services;

use App\Models\Booking;
use App\Repositories\BookingRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

final class BookingService
{
    public function __construct(private readonly BookingRepository $bookingRepository)
    {

    }

    public function create(Request $request): ?Booking
    {
        $request->merge(['booking_date' => Carbon::now()]);
        $request->merge(['booking_status' => false]);

        return $this->bookingRepository->create($request);
    }

    public function getItemsByAccommodationId(int $accommodationId): ?Collection
    {
        return $this->bookingRepository->getItemsByAccommodationId($accommodationId);
    }

    public function getByAccommodationIdAndTenantId(Request $request): ?Booking
    {
        $accommodationId = $request->input('accommodation_id');
        $tenantId = $request->input('tenant_id');

        return $this->bookingRepository->getByAccommodationIdAndTenantId($accommodationId, $tenantId);
    }

    public function update(Request $request): ?Booking
    {
        $request->merge(['booking_status' => 1]);

        $tenantId = $request->input('tenant_id');
        $accommodationId = $request->input('accommodation_id');

        $booking = $this->bookingRepository->getBookingByTenantAndAccommodationId($tenantId, $accommodationId);

        return $this->bookingRepository->update($booking, $request);
    }

    public function delete(Request $request): bool
    {
        $tenantId = $request->input('tenant_id');
        $accommodationId = $request->input('accommodation_id');
        $booking = $this->bookingRepository->getBookingByTenantAndAccommodationId($tenantId, $accommodationId);

        return $this->bookingRepository->delete($booking);
    }
}
