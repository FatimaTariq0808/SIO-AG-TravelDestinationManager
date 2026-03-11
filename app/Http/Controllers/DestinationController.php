<?php

namespace App\Http\Controllers;
use App\Http\Responses\BaseAPIResponse;
use App\Services\DestinationService;
use App\Http\Requests\DestinationRequest;
use App\Http\Requests\DestinationPaginationRequest;
use App\Http\Requests\DestinationSearchRequest;

class DestinationController extends Controller
{
    protected $destinationService;
    protected $per_page;
    protected $order;

    public function __construct(DestinationService $destinationService)
    {
        $this->destinationService = $destinationService;
    }
    public function getAllDestinations(DestinationPaginationRequest $request): BaseAPIResponse
    {
        $validated = $request->validated();
        $per_page = (int) ($validated['per_page'] ?? 10);
        $order = $validated['order'] ?? 'desc';
        $destinations = $this->destinationService->paginateDestinations($per_page, $order);
        return BaseAPIResponse::success($destinations, 'Destinations retrieved successfully');
    }
    public function getDestinationById($id): BaseAPIResponse
    {
        $destination = $this->destinationService->getDestinationById($id);
        return BaseAPIResponse::success($destination, 'Destination retrieved successfully');
    }

    public function createDestination(DestinationRequest $request): BaseAPIResponse
    {
        $destination = $this->destinationService->createDestination($request->validated());
        return BaseAPIResponse::success($destination, 'Destination created successfully', 201);
    }
    public function updateDestination(DestinationRequest $request, $id): BaseAPIResponse
    {
        $destination = $this->destinationService->updateDestination($id, $request->validated());
        return BaseAPIResponse::success($destination, 'Destination updated successfully');
    }
    public function deleteDestination($id): BaseAPIResponse
    {
        $this->destinationService->deleteDestination($id);
        return BaseAPIResponse::success(null, 'Destination deleted successfully');
    }
    public function searchDestinations(DestinationSearchRequest $request): BaseAPIResponse
    {
        $filters = $request->only(['activity', 'max_budget', 'travel_month']);

        $destinations = $this->destinationService->searchDestinations($filters);

        return BaseAPIResponse::success($destinations, 'Destination search completed successfully');
    }
}
