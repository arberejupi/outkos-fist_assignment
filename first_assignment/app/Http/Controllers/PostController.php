<?php 
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'content' => 'required'
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content
        ]);

        return response()->json($post);
    }
}

?>