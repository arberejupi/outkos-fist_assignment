<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserDetail;

class UserDetailController extends Controller
{
    /**
     * Store new user details.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $userDetail = UserDetail::create($request->all());

        return response()->json($userDetail, 201);
    }

    /**
     * Update existing user details.
     */
    public function update(Request $request, $id)
    {
        $userDetail = UserDetail::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'address' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $userDetail->update($request->all());

        return response()->json($userDetail);
    }

    /**
     * Delete a user detail.
     */
    public function destroy($id)
    {
        $userDetail = UserDetail::findOrFail($id);
        $userDetail->delete();

        return response()->json(['message' => 'User detail deleted successfully']);
    }

    /**
     * Show user detail.
     */
    public function show($id)
    {
        $userDetail = UserDetail::findOrFail($id);

        return response()->json($userDetail);
    }
}
