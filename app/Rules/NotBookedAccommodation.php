<?php

namespace App\Rules;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\ValidationRule;

class NotBookedAccommodation implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $client = new Client(['base_uri' => 'http://accommodation-service.loc']);

        $response = $client->get('api/accommodation/get', [
            'query' => ['accommodation_id' => $value],
        ]);

        $accommodation = json_decode(json_decode($response->getBody(), true));

        if (true === $accommodation->status) {
            dd('Эта комната уже забронирована! Пожалуйста, выберите другую!');
        }
    }
}
