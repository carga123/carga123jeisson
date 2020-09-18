@extends('layouts.app')

@section('content')

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cuenta.css') }}" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
    <style>
        .navbar{
            background-color:#fff;
            
        }
        .navbar>li{
            float: left;
        }
    </style>
</head>
<body>
   
    <div class="container">
        <h1>Nuevos Posts</h1>
        @foreach ($posts as $post)
        <div class="posts">
            <div class="contenido">
    
                <div class="post">
                    <h1>{{$post->title}}</h1>
                    <p class="texto">{{$post->content}}</p>
                <a class="btn btn-primary" href="{{ route('posts.show',$post->id) }}">Continuar leyendo</a>
                    <p>Creado: {{$post->created_at->diffForHumans()}} | ultima edición: {{$post->updated_at->diffForHumans()}}</p>
                </div>
    
                <div class="post">
                    <img src="{{$post->url_img}}" alt="{{$post->title}}">
                </div>
    
            </div>
    
    </div>
        @endforeach
    </div>

</body>
</html>
@endsection
