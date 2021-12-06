<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@extends('layouts.app')
@section('content')
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>オンライン旅行マッチングサービス</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <h1>旅行投稿一覧</h1>
        <form action="{{url('/search')}}" method="GET" class="form-inline my-2 my-lg-0 ml-2">
            <div class="form-group">
            <input type="text" name="keyword" value="" placeholder="キーワードを入力" class="form-control mr-sm-2">
            </div>
            <input type="submit" value="検索" class="btn btn-info">
        </form>
        <p class='video'>[<a href='/video'>ビデオチャット</a>]</p>
        <p class='myPage'>[<a href='/myPage'>マイページ</a>]</p>
        <p class='create'>[<a href='/posts/create'>投稿する</a>]</p>

        <div class='posts'>
            @if($posts->count())
                @foreach ($posts as $post)
                    <div class='border my-2 p-2'>
                        <small class='text-secondary'>written by {{ $post->user->name }}</small>
                        <a href='/posts/{{ $post->id }}'><h2 class='title'>{{ $post->title }}</h2></a>
                        <p class='p-2'>{{ $post->body }}</p>

                        <form action = "/reaction" method="POST">
                        @csrf
                        <input type="hidden" name="to_user_id" value="{{ $post->user->id }}">
                        <input type="hidden" name="status" value="1">
                        <button class='good' type=submit>旅行をリクエストする</button>
                        </form>

                        @foreach ($post->images as $post_image)
                            <img src="{{ $post_image->path }}" height="" width="">
                            <br>
                        @endforeach
                    </div>
                @endforeach
                    @else
                    <p>見つかりませんでした。</p>
            @endif
        </div>
        <div class="d-flex justify-content-center ">
           {{ $posts->appends(request()->input())->links() }}
        </div>
    </body>
    @endsection
</html>
