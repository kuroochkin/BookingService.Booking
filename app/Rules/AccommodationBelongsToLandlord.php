<?php

namespace App\Rules;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\ValidationRule;

class AccommodationBelongsToLandlord implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $client = new Client(['base_uri' => 'http://accommodation-service.loc']);

        $response = $client->get('api/landlord/accommodation/get', [
            'query' => ['accommodation_id' => $value]
        ]);

        $landlord = json_decode(json_decode($response->getBody(), true));

        if ((int)$value !== $landlord->accommodation_id) {
            $fail('Вы не имеете право обновлять эту комнату!');
        }
    }
}
