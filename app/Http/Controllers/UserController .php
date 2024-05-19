<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json(['success' => true, 'data' => $users], 200);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->json(['success' => true, 'data' => $user], 201);
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'error' => 'User not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $user], 200);
    }

    /**
     * Update the specified user in storage.
     *
     * @param UserRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UserRequest $request, int $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'error' => 'User not found'], 404);
        }

        $validatedData = $request->validated();

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->json(['success' => true, 'data' => $user], 200);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'error' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully'], 200);
    }
}
