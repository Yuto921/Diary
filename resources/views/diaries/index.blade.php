<!-- layout.blade.phpをテンプレとして使う -->
@extends('layouts.app')

<!-- layout.blade.phpのcontentの部分 -->
@section('content')
    <a href="{{ route('diary.create') }}" class="btn btn-primary btn-block">新規投稿</a>

    <!-- コントローラーから送られたキーで値をとる・この場合、$diariesがキーである -->
    @foreach($diaries as $diary)
        <div class="m-4 p-4 border border-primary">
            <p>{{$diary->title}}</p>
            <p>{{$diary->body}}</p>
            <p>{{$diary->created_at}}</p>

            <!-- ログインしている　Auth::check() && ログインしているユーザーの投稿であれば　Auth::user()->id === $diary->user_id -->
            @if(Auth::check() && Auth::user()->id === $diary->user_id) <!-- ログインしているユーザーの投稿であれば -->
            <a class="btn btn-success" href="{{ route('diary.edit', ['id' => $diary->id]) }}">編集</a>

            <form action="{{ route('diary.destroy', ['id' => $diary->id]) }}" method="POST" class="d-inline">
                @csrf
                @method('delete')
                <button class="btn btn-danger">削除</button>
            </form>
            @endif
            <div class="mt-3 ml-3">
                @if (Auth::check() && $diary->likes->contains(function ($user) {
                    return $user->id === Auth::user()->id;
                }))
                    <i class="far fa-heart fa-lg text-danger js-dislike"></i>
                @else
                    <i class="far fa-heart fa-lg text-danger js-like"></i>
                @endif
                <input class="diary-id" type="hidden" value="{{ $diary->id }}">
                <span class="js-like-num">{{ $diary->likes->count() }}</span>
            </div>
        </div>
    @endforeach
@endsection