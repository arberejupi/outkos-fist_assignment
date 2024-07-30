<?php 
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // Ensure that only admins can access this controller
    }

    public function deletePost($postId)
    {
        $user = JWTAuth::parseToken()->authenticate(); // Ensure user is authenticated
    
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $post = Post::find($postId);
    
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }
    
        if ($post->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
