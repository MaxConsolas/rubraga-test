<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\BookingFetchRequest;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use App\Repositories\Interfaces\BookingRepositoryInterface;

class BookingController extends Controller
{
    protected $roomRepository;
    protected $bookingRepository;

    public function __construct(
        RoomRepositoryInterface $roomRepository,
        BookingRepositoryInterface $bookingRepository
    ) {
        $this->roomRepository = $roomRepository;
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * Получить доступные комнаты
     */
    public function availableRooms(BookingFetchRequest $request)
    {
        $validated = $request->validated();
        
        $rooms = $this->roomRepository->getAvailable(
            $validated['start_date'],
            $validated['end_date'],
            $validated['guest_count']
        )->unique('room_type_id');

        return response()->json($rooms);
    }

    /**
     * Создать бронирование
     */
    public function store(BookingRequest $request)
    {
        $validated = $request->validated();

        if ($this->bookingRepository->findConflictingBookings(
            $validated['room_id'],
            $validated['start_date'],
            $validated['end_date']
        )) {
            return response()->json(['message' => 'Room is already booked for these dates'], 409);
        }
        // dd( $validated);
        $booking = $this->bookingRepository->createBooking([
            'room_id' => $validated['room_id'],
            'user_id' => auth()->id(),
            'check_in_date' => $validated['start_date'],
            'check_out_date' => $validated['end_date'],
            // 'guest_count' => $validated['guest_count'],
        ]);

        return response()->json($booking, 201);
    }
}
