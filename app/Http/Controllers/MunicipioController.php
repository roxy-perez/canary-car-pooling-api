<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use App\Classes\ApiResponseClass;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\MunicipioResource;
use App\Http\Requests\StoreMunicipioRequest;
use App\Http\Requests\UpdateMunicipioRequest;
use App\Interfaces\MunicipioRepositoryInterface;

class MunicipioController extends Controller
{
    private MunicipioRepositoryInterface $municipioRepository;
    public function __construct(MunicipioRepositoryInterface $municipioRepository)
    {
        $this->municipioRepository = $municipioRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->municipioRepository->index();
        return ApiResponseClass::sendResponse(MunicipioResource::collection($data), '', 200);
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
    public function store(StoreMunicipioRequest $request)
    {
        $details = [
            'code' => $request->code,
            'name' => $request->name,
            'provincia_id' => $request->provincia_id,
        ];
        DB::beginTransaction();
        try {
            $munipio = $this->municipioRepository->store($details);
            DB::commit();
            return ApiResponseClass::sendResponse(new MunicipioResource($munipio), 'Municipio created successfully', 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Municipio $municipio)
    {
        $municipio = $this->municipioRepository->getById($municipio->id);
        return ApiResponseClass::sendResponse(new MunicipioResource($municipio), '', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Municipio $municipio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMunicipioRequest $request, $id)
    {
        $updateDetails = [
            'code' => $request->code,
            'name' => $request->name,
            'provincia_id' => $request->provincia_id,
        ];
        DB::beginTransaction();
        try {
            $this->municipioRepository->update($updateDetails, $id);
            DB::commit();
            return ApiResponseClass::sendResponse('Municipio updated successfully', '', 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->municipioRepository->delete($id);
        return ApiResponseClass::sendResponse([], 'Municipio deleted successfully', 204);
    }
}
