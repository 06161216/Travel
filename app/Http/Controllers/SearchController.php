<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Post;
 
class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
 
        $query = Post::query();
 
        if (!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('body', 'LIKE', "%{$keyword}%");
        }
 
        $posts = $query->orderBy('updated_at', 'DESC')->paginate(2);
 
        return view('index', compact('posts', 'keyword'));
    }
}