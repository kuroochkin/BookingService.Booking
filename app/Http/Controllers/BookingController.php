<?php

namespace App\Http\Controllers;

use App\Events\DialogSenderIdsEvent;
use App\Http\Requests\BookingChangeRequest;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;

class BookingController extends BaseController
{
    public function __construct(private readonly BookingService $bookingService) {}

    public function create(BookingRequest $request): JsonResponse
    {
        $result = $this->bookingService->create($request);

        if (!$result) {
            return response()->json(['error' => 'Ошибка бронирования.'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        event(new DialogSenderIdsEvent($request->input('accommodation_id'), $request->input('tenant_id')));

        return response()->json(['success' => 'Успешно забронировано.'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function getItemsByAccommodationId(Request $request): JsonResponse
    {
        $accommodationId = $request->input('accommodation_id');
        $result = $this->bookingService->getItemsByAccommodationId($accommodationId);

        if (!$result) {
            return response()->json(['error' => 'Ошибка получения.'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return response()->json(['bookings' => $result->toJson()])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function getByAccommodationIdAndTenantId(Request $request): JsonResponse
    {
        $result = $this->bookingService->getByAccommodationIdAndTenantId($request);

        if (!$result) {
            return response()->json(['error' => 'Ошибка получения.'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return response()->json($result->toJson())->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function update(BookingChangeRequest $request): JsonResponse
    {
        $result = $this->bookingService->update($request);

        if (!$result) {
            return response()->json(['error' => 'Ошибка сохранения.'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return response()->json(['success' => 'Успешно сохранено.'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function delete(BookingChangeRequest $request): JsonResponse
    {
        $result = $this->bookingService->delete($request);

        if (!$result) {
            return response()->json(['error' => 'Ошибка удаления.'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return response()->json(['success' => 'Успешно удалено'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
