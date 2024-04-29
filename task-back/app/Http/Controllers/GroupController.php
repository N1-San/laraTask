<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\GroupRequest;

class GroupController extends Controller
{
    // Create a new group (POST)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'label' => 'required|string|max:255',
        ]);
    
        $group = Group::create($validatedData);
        return response()->json($group, 201);
    }

    // Read all groups (GET)
    public function index()
    {
        $groups = Group::all();

        return response()->json($groups);
    }

    // Update a group (PUT)
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'label' => 'required|string|max:255',
        ]);

        $group = Group::findOrFail($id);
        $group->update($validatedData);

        return response()->json($group);
    }

    // Delete a group (DELETE)
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();

        return response()->json(null, 204);
    }
}
