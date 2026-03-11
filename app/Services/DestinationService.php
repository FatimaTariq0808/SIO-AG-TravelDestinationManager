<?php

namespace App\Services;
use App\Exceptions\NotFoundException;
use App\Exceptions\InternalServerErrorException;
use App\Models\Document\Destination;
use App\Repositories\DestinationRepositoryInterface;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class DestinationService
{
    protected $destinationRepository;

    public function __construct(DestinationRepositoryInterface $destinationRepository)
    {
        $this->destinationRepository = $destinationRepository;
    }

    public function paginateDestinations(int $per_page = 10, string $order = 'desc'): LengthAwarePaginator
    {
        try {
            return $this->destinationRepository->paginateDestinations($per_page, $order);
        } catch (Exception $e) {
            throw new InternalServerErrorException("Unable to paginate destinations: " . $e->getMessage(), 500);
        }
    }
    public function getDestinationById($id): Destination
    {
        try {
            $destination = $this->destinationRepository->getDestinationById($id);
        } catch (Exception $e) {
            throw new InternalServerErrorException("Unable to retrieve destination: " . $e->getMessage(), 500);
        }
        if (!$destination) {
            throw new NotFoundException("Destination with ID {$id} not found.");
        }
        return $destination;
    }
    public function createDestination(array $data): Destination
    {
        try {
            return $this->destinationRepository->create($data);
        } catch (Exception $e) {
            throw new InternalServerErrorException("Unable to create destination: " . $e->getMessage(), 500);
        }
    }
    public function updateDestination($id, array $data): Destination
    {
        $destination = $this->getDestinationById($id);
        try {
            return $this->destinationRepository->update($destination, $data);
        } catch (Exception $e) {
            throw new InternalServerErrorException("Unable to update destination: " . $e->getMessage(), 500);
        }
    }
    public function deleteDestination($id): void
    {
        $destination = $this->getDestinationById($id);
        try {
            $this->destinationRepository->delete($destination);
        } catch (Exception $e) {
            throw new InternalServerErrorException("Unable to delete destination: " . $e->getMessage(), 500);
        }
    }
    public function searchDestinations(array $filters): Collection
    {
        try {
            return $this->destinationRepository->searchDestinations($filters);
        } catch (Exception $e) {
            throw new InternalServerErrorException("Unable to search destinations: " . $e->getMessage(), 500);
        }
    }
}