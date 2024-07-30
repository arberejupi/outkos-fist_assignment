<?php 
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public function __construct()
    {
<<<<<<< HEAD
        $this->middleware('check.admin'); 
    }

    public function deletePost($id)
    {
        $user = JWTAuth::parseToken()->authenticate(); 
=======
        $this->middleware('admin'); // Ensure that only admins can access this controller
    }

    public function deletePost($postId)
    {
        $user = JWTAuth::parseToken()->authenticate(); // Ensure user is authenticated
>>>>>>> d22e549536e19b2dc9859e7fe9e3e2dfe2a7366a
    
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
<<<<<<< HEAD
        $post = Post::find($id);
=======
        $post = Post::find($postId);
>>>>>>> d22e549536e19b2dc9859e7fe9e3e2dfe2a7366a
    
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
