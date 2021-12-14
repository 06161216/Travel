<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@extends('layouts.app')
@section('content')
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>マイページ</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="matching">
            @foreach($matchingIds as $matchingId)
                <form action="matching" method="POST">
                @csrf
                    @if( $matchingId->fromUser->id == Auth::id())
                        <p>{{ $matchingId->toUser->name }} とマッチング中</p>
                        <button type='submit'><a href='/chat/{{$matchingId->toUser->id}}'>チャット</a></button>
                    @elseif($matchingId->toUser->id == Auth::id())
                        <p>{{ $matchingId->fromUser->name }} とマッチング中</p>
                        <button type='submit'><a href='/chat/{{$matchingId->fromUser->id}}'>チャット</a></button>
                    @endif
                </form>
            @endforeach
        </div>
        <div class="requested">
            @foreach($likedUserIds as $likedUserId)
                <form action="/permission" method="POST">
                @csrf
                <p>{{ $likedUserId->fromUser->name }} から旅行リクエストが来ています！</p>
                <input type="hidden" name="from_id" value="{{$likedUserId->fromUser->id}}">
                <button type='submit'>許可</button>
                </form>
            @endforeach
        </div>
        <div class="requesting">
            {{--@foreach($toLikeUserIds->unique('to_user_id') as $toLikeUserId)--}}
            @foreach($toLikeUserIds as $toLikeUserId)
                <p>{{ $toLikeUserId->toUser->name }} に旅行リクエスト申請中</p>
            @endforeach
        </div>
        <div class='back'>[<a href='/'>戻る</a>]</div>
    </body>
    @endsection
</html>
