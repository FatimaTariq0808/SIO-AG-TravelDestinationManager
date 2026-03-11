<?php

namespace App\Repositories;
use App\Models\Document\Destination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EloquentDestinationRepository implements DestinationRepositoryInterface
{

    public function paginateDestinations(int $per_page = 10, string $order = 'desc'): LengthAwarePaginator
    {
        return Destination::orderBy('created_at', $order)->paginate($per_page);
    }
    public function getDestinationById($id): Destination|null
    {
        return Destination::find($id);
    }
    public function create(array $data): Destination
    {
        return Destination::create($data);
    }
    public function update(Destination $destination, array $data): Destination
    {
        $destination->update($data);
        return $destination;
    }
    public function delete(Destination $destination): void
    {
        $destination->delete();
    }
    public function searchDestinations(array $filters): Collection
    {
        $activity = $filters['activity'] ?? null;
        $travelMonth = $filters['travel_month'] ?? null;
        $maxBudget = $filters['max_budget'] ?? null;

        return Destination::orderBy('created_at', 'desc')
            ->get()
            ->filter(function (Destination $destination) use ($activity, $travelMonth, $maxBudget) {
                if ($activity) {
                    $activities = normalizeArrayField($destination->activities);
                    if (!in_array(strtolower($activity), $activities, true)) {
                        return false;
                    }
                }
                if ($maxBudget !== null && (float) $destination->average_cost > (float) $maxBudget) {
                    return false;
                }
                if ($travelMonth) {
                    $months = normalizeArrayField($destination->best_travel_months);
                    if (!in_array(strtolower($travelMonth), $months, true)) {
                        return false;
                    }
                }

                return true;
            })
            ->values();
    }
}