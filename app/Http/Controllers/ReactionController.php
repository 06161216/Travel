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
        //自分で自分に旅行リクエストが出来ないようにする
        if(Auth::user()->id != $request['to_user_id']){
        //すでにreactionsテーブルにあるか確認/無ければ保存
        $alreadyReaction = Reaction::where('from_user_id', Auth::user()->id)
                        ->where('to_user_id', $request->input('to_user_id'))
                        ->first();
                    if ($alreadyReaction == null) {
                        Reaction::create([
                            'from_user_id'=>Auth::user()->id,
                            'to_user_id'=>$request->input('to_user_id'),
                            'status'=>$request->input('status')
                            ]);
                        return redirect('/');
                    }
                    else{
                        return redirect('/');
                    };
        }
        else{
            return redirect('/');
        };
    }

    public function show()
    {
        $likedUserIds = Reaction::where('to_user_id', Auth::user()->id)
                                ->where('status', 1);

        $toLikeUserIds = Reaction::where('from_user_id', Auth::user()->id)
                                ->where('status', 1);
        //マッチング（status=2）しているレコードを検索
        $query = Reaction::where(function($query)
                                {
                                    $query->where('status', 2);
                                })
                                ->where(function($query)
                                {
                                    $query->orWhere('from_user_id', Auth::user()->id)
                                          ->orWhere('to_user_id', Auth::user()->id);
                                });
        //チャットのため
        // $user = Auth::user();
        // ログイン者以外のユーザを取得する
        // $users = User::where('id' ,'<>' , $user->id)->get();
        // チャットユーザ選択画面を表示
        // return view('chat_user_select' , compact('users'));
            // dd($query->get());
        return view('/myPage')->with([
            'likedUserIds'=>$likedUserIds->get(),
            'toLikeUserIds'=>$toLikeUserIds->get(),
            'matchingIds'=>$query->get()
            ]);
    }

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
