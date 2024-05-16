<?php

namespace App\Rules;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\ValidationRule;

class AccommodationExists implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $client = new Client(['base_uri' => 'http://accommodation-service.loc']);

        $response = $client->get('api/accommodation/get', [
            'query' => ['accommodation_id' => $value],
        ]);

        if (isset(json_decode($response->getBody())->error)) {
            dd('Такой комнаты не существует!');
        }
    }
}
