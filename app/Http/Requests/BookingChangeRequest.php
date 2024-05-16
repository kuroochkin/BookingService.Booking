<?php

namespace App\Http\Requests;

use App\Rules\AccommodationAndTenantAreUniques;
use App\Rules\AccommodationBelongsToLandlord;
use App\Rules\AccommodationExists;
use Illuminate\Foundation\Http\FormRequest;

class BookingChangeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'accommodation_id' => [
                'required',
                'int',
                new AccommodationExists(),
                new AccommodationBelongsToLandlord(),
            ],

            'tenant_id' => [
                'required',
                'int',
                'exists:bookings,tenant_id',
            ],
        ];
    }
}
