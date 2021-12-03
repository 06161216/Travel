<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Image;
use App\Post;

class ImageController extends Controller
{
    public function input()
    {
        return view('images.input');
    }

    public function upload(Request $request, Post $post)
    {        
        $this->validate($request, [
            'file' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ]
        ]);

        if ($request->file('file')->isValid([])) {
            //バリデーションを正常に通過した時の処理
            //S3へのファイルアップロード処理の時の情報を変数$upload_infoに格納する
            $upload_info = Storage::disk('s3')->putFile('/post-images', $request->file('file'), 'public');
            //S3へのファイルアップロード処理の時の情報が格納された変数$upload_infoを用いてアップロードされた画像へのリンクURLを変数$pathに格納する
            $path = Storage::disk('s3')->url($upload_info);
            //現在ログイン中のユーザIDを変数$user_idに格納する
            $post_id = $post->id;
            // $post_id = $post->id;
            //モデルファイルのクラスからインスタンスを作成し、オブジェクト変数$new_image_dataに格納する
            $new_image_data = new Image();
            //プロパティ(静的メソッド)user_idに変数$user_idに格納されている内容を格納する
            $new_image_data->post_id = $post_id;
            //プロパティ(静的メソッド)に変数$pathに格納されている内容を格納する
            $new_image_data->path = $path;
            //インスタンスの内容をDBのテーブルに格納する
            $new_image_data->save();

            return redirect('/');
        }else{
            return redirect('/upload/image');
        }
        
    }
    public function output(Post $post)
    {
        //現在ログイン中のユーザIDを変数$user_idに格納する
        // $post_id = Post::id();
        $post_id = $post->id;
        //imagesテーブルからuser_idカラムが変数$user_idと一致するレコード情報を取得し変数$user_imagesに格納する
        $post_images = Image::wherePost_id($post_id)->get();
        return view('images.output', ['post_images' => $post_images]);
    }
}
