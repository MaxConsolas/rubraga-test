<?php
namespace App\Repositories\Interfaces;

interface BookingRepositoryInterface
{
    public function createBooking(array $data);
    public function findConflictingBookings(int $roomId, string $startDate, string $endDate);
}