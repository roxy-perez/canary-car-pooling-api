<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Interfaces\RoleRepositoryInterface;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    private $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->middleware('auth:sanctum');
        $this->middleware(function ($request, $next) {
            if (Gate::denies('create', Role::class)) {
                return response()->json(['message' => 'Forbidden'], 403);
            }
            return $next($request);
        })->only(['store', 'update']);
    }

    public function store(RoleRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $role = $this->roleRepository->create($data);
            DB::commit();
            return new RoleResource($role);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while creating the role.'], 500);
        }
    }

    public function update(RoleRequest $request, $id)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $role = $this->roleRepository->update($data, $id);
            DB::commit();
            return new RoleResource($role);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred while updating the role.'], 500);
        }
    }
}
