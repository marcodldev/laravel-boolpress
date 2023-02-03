<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>

h1 {
    text-align: center;
}

</style>
<body>
    <h1>Hai appena inserito un post: {{ $post->title }}</h1>

    <p>
        il testo: {{ $post->body }}
    </p>

  <p>
    {{$post->category->name}}
  </p>

  <ul>
    @foreach ($post->tags as $elem)
        <li>{{$elem->name}}</li>
    @endforeach
  </ul>

</body>
</html>
