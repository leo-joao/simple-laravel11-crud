<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Return all users, paginated by 15
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::orderBy('id', 'DESC')->paginate(15);
        return response()->json([
            'status' => true,
            'users' => $users
        ], 200);
    }

    /**
     * Returns a specific User
     * @param \App\Models\User
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'status' => true,
            'user' => $user
        ], 200);
    }

    public function store(UserRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "User sucesfully registered!",
                'user' => $user
            ], 201);

        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => "User not registered!"
            ], 400);
        }
    }

    public function update(UserRequest $request, User $user): JsonResponse
    {

        DB::beginTransaction();

        try {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'user' => $request,
                'message' => "User edited sucessfuly!"
            ], 200);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => "User not edited!"
            ], 400);
        }
    }

    public function destroy(User $user): JsonResponse
    {

        try {
            $user->delete();

            return response()->json([
                'status' => false,
                'user' => $user,
                'message' => "User successfuly deleted!"
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'status' => false,
                'message' => "User not deleted!"
            ], 400);
        }
    }
}
