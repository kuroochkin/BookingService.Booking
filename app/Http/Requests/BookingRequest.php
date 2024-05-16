<?php

namespace App\Http\Requests;

use App\Rules\AccommodationAndTenantAreUniques;
use App\Rules\AccommodationExists;
use App\Rules\NotBookedAccommodation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BookingRequest extends FormRequest
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
                new NotBookedAccommodation,
                new AccommodationAndTenantAreUniques($this->input('tenant_id'), $this->input('accommodation_id')),
            ],
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'tenant_id' => [
                'required',
                'int',
                'exists:tenants,id',
                new AccommodationAndTenantAreUniques($this->input('tenant_id'), $this->input('accommodation_id')),
            ],
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
