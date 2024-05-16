<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Tenant;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCanCreateBooking(): void
    {
        Tenant::factory()->create([
            'id' => 'ae694f47-75b8-405c-84eb-5de03dec36a6',
        ]);
        $requestData = [
            'start_date' => Carbon::now()->addDay()->timezone('Europe/Moscow')->format('d-m-Y H:i:s'),
            'end_date' => Carbon::now()->addDay()->addDay()->timezone('Europe/Moscow')->format('d-m-Y H:i:s'),
            'accommodation_id' => 'f5793adb-29f9-41ac-87a5-4bda51b61383',
            'tenant_id' => 'ae694f47-75b8-405c-84eb-5de03dec36a6',
        ];

        $this->post('api/booking/create', $requestData);

        $this->assertDatabaseCount('bookings', 1);
        $this->assertDatabaseHas('bookings', $requestData);
    }
}
