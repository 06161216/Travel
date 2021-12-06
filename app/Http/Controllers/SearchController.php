<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
 
class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
 
        $query = Post::query();

        if (!empty($keyword)) {
            $query->where('title', 'LIKE', '%' . $keyword . '%')
                ->orWhere('body', 'LIKE', '%' . $keyword . '%')
                //投稿者の名前も検索
                ->orWhereHas('user', function ($query) use ($keyword){
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }
 
        $posts = $query->orderBy('updated_at', 'DESC')->paginate(2);
 
        return view('index', compact('posts', 'keyword'));
    }
}