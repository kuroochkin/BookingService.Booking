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
            'landlord_id' => [
                'required',
                'string',
                new LandlordExists(),
            ],
            'accommodation_id' => [
                'required',
                'string',
                new AccommodationExists(),
                new AccommodationBelongsToLandlord($this->input('landlord_id')),
            ],

            'tenant_id' => [
                'required',
                'int',
                'exists:bookings,tenant_id',
            ],
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $messages = $validator->errors()->messages();

        if (isset($messages['tenant_id'])) {
            dd('Такой житель не бронировал комнату!');
        }

        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
