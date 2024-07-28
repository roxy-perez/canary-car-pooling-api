<?php

namespace App\Http\Controllers;

use App\Http\Resources\RideResource;
use App\Http\Requests\StoreRideRequest;
use App\Http\Requests\UpdateRideRequest;
use App\Interfaces\RideRepositoryInterface;
use App\Classes\ApiResponseClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;

class RideController extends Controller
{
    private RideRepositoryInterface $rideRepository;

    public function __construct(RideRepositoryInterface $rideRepository)
    {
        $this->rideRepository = $rideRepository;
    }

    public function index()
    {
        $data = $this->rideRepository->all();
        return ApiResponseClass::sendResponse(RideResource::collection($data), '', 200);
    }

    public function show($id)
    {
        $ride = $this->rideRepository->find($id);
        return ApiResponseClass::sendResponse(new RideResource($ride), '', 200);
    }

    public function store(StoreRideRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $ride = $this->rideRepository->create($data);
            DB::commit();
            return ApiResponseClass::sendResponse(new RideResource($ride), 'Ride created successfully', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    public function update(UpdateRideRequest $request, $id)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $this->rideRepository->update($data, $id);
            DB::commit();
            return ApiResponseClass::sendResponse('Ride updated successfully', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    public function destroy($id)
    {
        $this->rideRepository->delete($id);
        return ApiResponseClass::sendResponse('Ride deleted successfully', 204);
    }
}
