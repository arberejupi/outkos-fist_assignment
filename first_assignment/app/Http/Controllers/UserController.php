<?php 
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function updatePost(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate(); // Get the authenticated user

        $post = Post::where('id', $id)->where('user_id', $user->id)->first();

        if (!$post) {
            return response()->json(['message' => 'Post not found or unauthorized'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post->update($validator->validated());

        return response()->json($post);
    }

    public function deletePost($id)
    {
        $user = JWTAuth::parseToken()->authenticate(); // Get the authenticated user

        $post = Post::where('id', $id)->where('user_id', $user->id)->first();

        if (!$post) {
            return response()->json(['message' => 'Post not found or unauthorized'], 404);
        }

        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}