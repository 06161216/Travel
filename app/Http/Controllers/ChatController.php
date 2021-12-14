<?php
 
namespace App\Http\Controllers;
 
use App\Mail\SampleNotification;
use Illuminate\Http\Request;
use App\Events\ChatMessageRecieved;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
 
class ChatController extends Controller
{
 
    public function __construct()
    {
    }

    // public function select()
    // {
    //     $user = Auth::user();
 
    //     // ログイン者以外のユーザを取得する
    //     $users = User::where('id' ,'<>' , $user->id)->get();
    //     // チャットユーザ選択画面を表示
    //     return view('chat_user_select' , compact('users'));
    // }
 
    public function index(Request $request , $recieve)
    {
        // チャットの画面
        $loginId = Auth::id();
 
        $param = [
          'send' => $loginId,
          'recieve' => $recieve,
        ];
 
        // 送信 / 受信のメッセージを取得する
        $query = Message::where('send' , $loginId)->where('recieve' , $recieve);;
        $query->orWhere(function($query) use($loginId , $recieve){
            $query->where('send' , $recieve);
            $query->where('recieve' , $loginId);
 
        });
 
        $messages = $query->get();
 
        return view('chat' , compact('param' , 'messages'));
    }
 
    /**
     * メッセージの保存をする
     */
    public function store(Request $request)
    {
 
        // リクエストパラメータ取得
        $insertParam = [
            'send' => $request->input('send'),
            'recieve' => $request->input('recieve'),
            'message' => $request->input('message'),
        ];
        // dd($insertParam);
        // $send = $request->input('send');
        $recieve = $request->input('recieve');
        // dd($send);

        // メッセージデータ保存
        try{
            Message::insert($insertParam);
        }catch (\Exception $e){
            return false;
 
        }
    
    return redirect('/chat/' . $recieve);
 
 
        // イベント発火
        // event(new ChatMessageRecieved($request->all()));
 
        // // メール送信
        // $mailSendUser = User::where('id' , $request->input('recieve'))->first();
        // $to = $mailSendUser->email;
        // Mail::to($to)->send(new SampleNotification());
 
        // return true;
 
    }
}