<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reaction;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;

class ReactionController extends Controller
{
    public function input(Request $request)
    {
        // dd($request->all());
        
        $alreadyReaction = Reaction::where('from_user_id', Auth::user()->id)
                        ->where('to_user_id', $request->input('to_user_id'))
                        ->where('status', 1)
                        ->first();
                    if ($alreadyReaction === null) {
                        Reaction::create([
                            'from_user_id'=>Auth::user()->id,
                            'to_user_id'=>$request->input('to_user_id'),
                            'status'=>$request->input('status')
                            ]);
                        return redirect('/');
                    }
                    else{
                        return redirect('/');
                    }
    }
    
    public function show()
    {
        $likedUserIds = Reaction::where('to_user_id', Auth::user()->id)
                                ->where('status', 1);

        $toLikeUserIds = Reaction::where('from_user_id', Auth::user()->id)
                                ->where('status', 1);
        
        $query = Reaction::where(function($query)
                                {
                                    $query->where('status', 2);
                                })
                                ->where(function($query)
                                {
                                    $query->orWhere('from_user_id', Auth::user()->id)
                                          ->orWhere('to_user_id', Auth::user()->id);
                                });
            // dd($query->get());

        return view('/myPage')->with([
            'likedUserIds'=>$likedUserIds->get(),
            'toLikeUserIds'=>$toLikeUserIds->get(),
            'matchingIds'=>$query->get()
            ]);

        // dd($likedUserIds);
    }
    
    // public function requestTravel(Post $post)
    // {
    //     $toRequest = Reaction::where('to_user_id', $post->id)
    //                         ->where('from_user_id', Auth::user()->id)
    //                         ->where('status', 1)
    //                         ->get();
        
    //     return view('/');
    // }
    
    public function match(Request $request)
    {
        $from_id = $request['from_id'];
        
        $reaction = Reaction::where('from_user_id', $from_id)
                            ->where('to_user_id', Auth::user()->id)
                            ->first();
        $reaction->status = 2;
        $reaction->save();
        
        return redirect('/myPage');
    }
}
