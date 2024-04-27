<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Create a new user (POST)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'groups' => 'required|string|max:255',
        ]);
    
        $user = User::create($validatedData);
        return response()->json($user, 201);
    }

    // Read all users (GET)
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    // Update a user (PUT)
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'groups' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);

        return response()->json($user);
    }

    // Delete a user (DELETE)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
    public function show($id)
{
    $user = User::find($id);
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }
    return response()->json($user);
}
}
