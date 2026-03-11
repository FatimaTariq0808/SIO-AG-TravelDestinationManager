<?php

namespace App\Repositories;
use App\Models\Document\Destination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface DestinationRepositoryInterface
{
    public function paginateDestinations(int $per_page = 10, string $order = 'desc'): LengthAwarePaginator;
    public function getDestinationById($id): Destination|null;
    public function create(array $data): Destination;
    public function update(Destination $destination, array $data): Destination;
    public function delete(Destination $destination): void;
    public function searchDestinations(array $filters): Collection;
}