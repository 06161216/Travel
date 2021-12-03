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
           <form action="/posts" method="POST" enctype="multipart/form-data">
           {{ csrf_field() }}
           <div class="title">
               <h2>Title</h2>
               <input type="text" name ="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
               <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
           </div>
          <div class="body">
               <h2>Body</h2>
               <textarea name="post[body]" placeholder="本文">{{ old('post.body') }}</textarea>
               <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
           </div>
                @csrf
                <label for="photo">画像ファイル:</label>
                <input type="file" class="form-control" name="file">
                <br>
           <input type="submit" value ="投稿する"/>
           <div class='back'>[<a href='/'>戻る</a>]</div>
    </body>
    @endsection
</html>
