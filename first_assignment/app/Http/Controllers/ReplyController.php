<?php 
namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ReplyController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|exists:posts,id',
            'content' => 'required'
        ]);

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'content' => $request->content
        ]);

        return response()->json($reply);
    }
}

?>