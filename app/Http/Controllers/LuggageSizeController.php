<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreLuggageSizeRequest;
use App\Http\Requests\UpdateLuggageSizeRequest;
use App\Http\Resources\LuggageSizeResource;
use App\Models\LuggageSize;
use App\Classes\ApiResponseHelper;
use Illuminate\Support\Facades\DB;

class LuggageSizeController extends Controller
{
    public function index()
    {
        $data = LuggageSize::all();
        return ApiResponseHelper::sendResponse(LuggageSizeResource::collection($data), '', 200);
    }

    public function show($id)
    {
        $luggageSize = LuggageSize::findOrFail($id);
        return ApiResponseHelper::sendResponse(new LuggageSizeResource($luggageSize), '', 200);
    }

    public function store(StoreLuggageSizeRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $luggageSize = LuggageSize::create($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new LuggageSizeResource($luggageSize), 'Luggage Size created successfully', 201);
        } catch (\Exception $ex) {
            return ApiResponseHelper::rollback($ex);
        }
    }

    public function update(UpdateLuggageSizeRequest $request, $id)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $luggageSize = LuggageSize::findOrFail($id);
            $luggageSize->update($data);
            DB::commit();
            return ApiResponseHelper::sendResponse('Luggage Size updated successfully', 201);
        } catch (\Exception $ex) {
            return ApiResponseHelper::rollback($ex);
        }
    }

    public function destroy($id)
    {
        LuggageSize::destroy($id);
        return ApiResponseHelper::sendResponse('Luggage Size deleted successfully', 204);
    }
}
