<?php
namespace App\Repositories;

use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Models\Booking;

class BookingRepository implements BookingRepositoryInterface
{
    protected Booking $model;

    public function __construct(Booking $model)
    {
        $this->model = $model;
    }

    public function createBooking(array $data): Booking
    {
        return $this->model->create($data);
    }

    public function findConflictingBookings(int $roomId, string $startDate, string $endDate): bool
    {
        return $this->model
            ->where('room_id', $roomId)
            ->overlap($startDate, $endDate)
            ->exists();
    }
}