<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <title>一覧表示画面</title>
</head>
<body>
    <h1>一覧画面</h1>

    <!-- コントローラーから送られたキーで値をとる・この場合、$diariesがキーである -->
    @foreach($diaries as $diary)
        <div class="m-4 p-4 border border-primary">
            <p>{{$diary->title}}</p>
            <p>{{$diary->body}}</p>
            <p>{{$diary->created_at}}</p>
        </div>
    @endforeach
</body>
</html>