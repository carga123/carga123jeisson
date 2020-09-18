@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mi Cuenta</title>
    <link href="{{ asset('css/cuenta.css') }}" rel="stylesheet">
</head>
<body>
    
<div class="container">
    <h1>Hola {{ Auth::user()->name }}, Aqui estan tus Post</h1>
    
    <a class="btn btn-primary newPost" href="{{route('posts.create')}}">Crear un nuevo post</a>
    @foreach ($posts as $post)
    <div class="posts">
        <div class="contenido">

            <div class="post">
                <h1>{{$post->title}}</h1>
                <p>{{$post->content}}</p>
            </div>

            <div class="post">
                @php 
                $info = new SplFileInfo("$post->url_img");
                $file = $info->getExtension();
                @endphp
                @if($file == "mp4")
                <video id="image" src="{{ asset("$post->url_img") }}" autoplay muted loop></video>
                @else
                <img id="image" src="{{ asset("$post->url_img") }}" />
                @endif
                <p>Creado: {{$post->created_at->diffForHumans()}}</p>
                <p>Ultima edición: {{$post->updated_at->diffForHumans()}}</p>
                <h2>Mas opciones del post</h2>
                <a class="btn btn-primary" href="{{route('posts.edit',$post->id)}}">Editar</a>

            <form action="{{route('posts.destroy',$post->id)}}" method="post">
                @method('DELETE')
            {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">Borrar</button>
            </form>
            
            </div>

        </div>

</div>
    @endforeach
</div>
</body>
</html>
@endsection
