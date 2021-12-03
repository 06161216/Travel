@extends('layouts.app')

@section('content')
    <a href="/upload/image">画像のアップロードに戻る</a>
    <br>
    @foreach ($post_images as $post_image)
        <img src="{{ $post_image['path'] }}">
        <br>
    @endforeach
@endsection