<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Classes\ApiResponseHelper;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CarResource;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Interfaces\CarRepositoryInterface;

class CarController extends Controller
{
    use AuthorizesRequests;

    private CarRepositoryInterface $carRepository;

    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function index()
    {
        $this->authorize('viewAny', Car::class);
        $data = $this->carRepository->index();
        return ApiResponseHelper::sendResponse(CarResource::collection($data), '', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $this->authorize('create', Car::class);
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $car = $this->carRepository->store($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new CarResource($car), 'Car created successfully', 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $car = $this->carRepository->getById($id);
        $this->authorize('view', $car);
        return ApiResponseHelper::sendResponse(new CarResource($car), '', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, $id)
    {
        $car = $this->carRepository->getById($id);
        $this->authorize('update', $car);
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $this->carRepository->update($data, $id);
            DB::commit();
            return ApiResponseHelper::sendResponse('Car updated successfully', 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $car = $this->carRepository->getById($id);
        $this->authorize('delete', $car);
        $this->carRepository->delete($id);
        return ApiResponseHelper::sendResponse('Car deleted successfully', 204);
    }
}
