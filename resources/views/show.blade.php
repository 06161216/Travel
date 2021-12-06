<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @extends('layouts.app')
    @section('content')
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
       <h1>投稿</h1
       <p class='edit'>[<a href="/posts/{{ $post->id }}/edit">編集する</a>]</p>
       <form action="/posts/{{ $post->id }}" id="form_delete" method="post">
           {{ csrf_field() }}
           {{ method_field('delete') }}
           <input type="submit" style="display:none">
           <p class='delete'>[<span onclick="return deletePost(this);">削除</span>]</p>
       </form>
           <div class='post'>

               <form action = "/reaction" method="POST">
                    @csrf
                    <input type="hidden" name="to_user_id" value="{{ $post->user->id }}">
                    <input type="hidden" name="status" value="1">
                    <button class='good' type=submit>旅行をリクエストする</button>
                </form>

               <small>written by {{ $post->user->name }}</small>
               <h2 class='title'>{{ $post->title }}</h2>
               <p class='body'>{{ $post->body }}</p>
               <p class='updated_at'>{{ $post->updated_at }}</p>

               @foreach ($post->images as $post_image)
                    <img src="{{ $post_image->path }}" height="200" width="400">
                    <br>
                @endforeach

           </div>
           <div class='back'>[<a href='/'>戻る</a>]</div>
           <script>
               function deletePost(e){
                   'use strict';
                   if(confirm('削除すると復元できません。\n本当に削除しますか？')){
                       document.getElementById('form_delete').submit();
                   }
               }
           </script>
    </body>
    @endsection
</html>
