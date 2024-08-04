<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use App\Classes\ApiResponseHelper;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProvinciaRequest;
use App\Http\Requests\UpdateProvinciaRequest;
use App\Interfaces\ProvinciaRepositoryInterface;

class ProvinciaController extends Controller
{
    private ProvinciaRepositoryInterface $provinciaRepository;
    public function __construct(ProvinciaRepositoryInterface $provinciaRepository)
    {
        $this->provinciaRepository = $provinciaRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->provinciaRepository->index();
        return ApiResponseHelper::sendResponse($data, '', 200);
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
    public function store(StoreProvinciaRequest $request)
    {
        $details = [
            'code' => $request->code,
            'name' => $request->name,
        ];
        DB::beginTransaction();
        try {
            $provincia = $this->provinciaRepository->store($details);
            DB::commit();
            return ApiResponseHelper::sendResponse($provincia, 'Provincia created successfully', 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Provincia $provincia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provincia $provincia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProvinciaRequest $request, $id)
    {
        $details = [
            'code' => $request->code,
            'name' => $request->name,
        ];
        DB::beginTransaction();
        try {
            $provincia = $this->provinciaRepository->update($details, $id);
            DB::commit();
            return ApiResponseHelper::sendResponse('Provincia updated successfully', 201);
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
        DB::beginTransaction();
        try {
            $this->provinciaRepository->delete($id);
            DB::commit();
            return ApiResponseHelper::sendResponse('Provincia deleted successfully', 204);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }
}
