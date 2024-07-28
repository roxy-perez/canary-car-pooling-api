<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
  protected $userRepository;

  public function __construct(UserRepositoryInterface $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function index()
  {
    $users = $this->userRepository->index();
    return UserResource::collection($users);
  }

  public function show($id)
  {
    $user = $this->userRepository->findById($id);
    return new UserResource($user);
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'full_name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8',
      'contact_number' => 'nullable|string|max:255',
      'driving_license_number' => 'nullable|string|max:255',
      'driving_license_valid_from' => 'nullable|date',
      'profile_picture' => 'nullable|string|max:255',
    ]);

    $validatedData['password'] = bcrypt($validatedData['password']);

    if ($request->hasFile('profile_picture')) {
      $validatedData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures');
    }

    $user = $this->userRepository->create($validatedData);
    return new UserResource($user);
  }

  public function update(Request $request, $id)
  {
    $validatedData = $request->validate([
      'full_name' => 'sometimes|required|string|max:255',
      'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
      'password' => 'sometimes|required|string|min:8',
      'contact_number' => 'nullable|string|max:255',
      'driving_license_number' => 'nullable|string|max:255',
      'driving_license_valid_from' => 'nullable|date',
      'profile_picture' => 'nullable|string|max:255',
    ]);

    if (isset($validatedData['password'])) {
      $validatedData['password'] = bcrypt($validatedData['password']);
    }

    if ($request->hasFile('profile_picture')) {
      $validatedData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures');
    }

    $user = $this->userRepository->update($id, $validatedData);
    return new UserResource($user);
  }

  public function destroy($id)
  {
    $this->userRepository->delete($id);
    return response(null, 204);
  }
}
