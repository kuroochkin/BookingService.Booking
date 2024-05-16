<?php

namespace App\Listeners;

use App\Events\DialogSenderIdsEvent;
use GuzzleHttp\Client;

class SendDialogServiceIdsListener
{
    public function handle(DialogSenderIdsEvent $event): void
    {
        $tenantId = $event->tenantId;
        $landlordId = json_decode(json_decode($this->getLandlordByAccommodationId($event->accommodationId)));

        $client = new Client(['base_uri' => 'http://dialog-service.loc']);

        $response = $client->request('POST', 'api/dialog/create', [
            'query' => ['landlord_id' => $landlordId->id, 'tenant_id' => $tenantId],
        ]);
    }

    private function getLandlordByAccommodationId(int $accommodationId): string
    {
        $client = new Client(['base_uri' => 'http://accommodation-service.loc']);

        return $client->get('api/landlord/accommodation/get', [
            'query' => ['accommodation_id' => $accommodationId],
        ])->getBody()->getContents();
    }
}
