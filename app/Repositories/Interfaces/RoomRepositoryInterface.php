<?php
namespace App\Repositories\Interfaces;

use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;

interface RoomRepositoryInterface
{
    public function getAvailable(string $startDate, string $endDate, int $guestCount): Collection;
}