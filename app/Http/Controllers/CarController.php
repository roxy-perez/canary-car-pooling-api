<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Classes\ApiResponseClass;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CarResource;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Interfaces\CarRepositoryInterface;

class CarController extends Controller
{
    private  CarRepositoryInterface $carRepository;
    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->carRepository->index();
        return ApiResponseClass::sendResponse(CarResource::collection($data), '', 200);
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
        $data = [
            'name' => $request->name,
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'comfort_level' => $request->comfort_level
        ];

        DB::beginTransaction();
        try {
            $car = $this->carRepository->store($data);
            DB::commit();
            return ApiResponseClass::sendResponse(new CarResource($car), 'Car created successfully', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $car = $this->carRepository->getById($id);
        return ApiResponseClass::sendResponse(new CarResource($car), '', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, $id)
    {
        $updateData = [
            'name' => $request->name,
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'comfort_level' => $request->comfort_level
        ];
        DB::beginTransaction();
        try {
            $this->carRepository->update($updateData, $id);
            DB::commit();
            return ApiResponseClass::sendResponse('Car updated successfully', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->carRepository->delete($id);
        return ApiResponseClass::sendResponse('Car deleted successfully', 204);
    }
}
