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
       <h1>投稿</h1>
       <form action="/posts/{{ $post->id }}" method="POST">
           {{ csrf_field() }}
           @method('PUT')
           <div class="title">
               <h2>Title</h2>
               <input type="text" name ="post[title]" placeholder="タイトル" value="{{ $post->title }}"/>
           </div>
          <div class="body">
               <h2>Body</h2>
               <textarea name="post[body]" placeholder="本文">{{ $post->body }}</textarea>
           </div>
           <input type="submit" value ="更新する"/>

           <div class='back'>[<a href='/posts/{{ $post->id }}'>戻る</a>]</div>
    </body>
    @endsection
</html>
