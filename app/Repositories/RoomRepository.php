<?php

namespace App\Repositories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\RoomRepositoryInterface;

class RoomRepository implements RoomRepositoryInterface
{
    protected $model;

    public function __construct(Room $model)
    {
        $this->model = $model;
    }

    public function getAvailable(string $startDate, string $endDate, int $guestCount): Collection
    {
        return $this->model
            ->where('capacity', $guestCount)
            ->whereDoesntHave('bookings', function ($q) use ($startDate, $endDate) {
                $q->overlap($startDate, $endDate);
            })
            ->with(['type'])
            ->get();
    }
}