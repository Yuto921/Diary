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
        </div>
    @endforeach
@endsection