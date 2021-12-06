{{--DOCTYPE html>
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
        <h1>検索</h1>
         
        <form action="{{url('/posts')}}" method="GET">
            <p><input type="text" name="keyword" value="{{$keyword}}"></p>
            <p><input type="submit" value="検索"></p>
        </form>
         
        @if($posts->count())
         
        <table border="1">
            <tr>
                <th>title</th>
                <th>body</th>
            </tr>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
            </tr>
            @endforeach
        </table>
         
        @else
        <p>見つかりませんでした。</p>
        @endif
    </body>
   @endsection
</html>