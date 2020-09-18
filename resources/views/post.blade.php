@extends('layouts.app')

@section('content')


<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/mostrarPost.css') }}" rel="stylesheet">
<title>Post</title>
</head>
<body>
{{-- post --}}
    <div id="container">
        @php 
        $info = new SplFileInfo("$post->url_img");
        $file = $info->getExtension();
        @endphp
        @if($file == "mp4")
        <video id="image" src="{{ asset("$post->url_img") }}" autoplay muted loop></video>
        @else
        <img id="image" src="{{ asset("$post->url_img") }}" />
        @endif
    
        <p id="text">
          {{$post->title}}
        </p>
   </div>
    <div class="container">
        <p>Creado: {{$post->created_at->diffForHumans()}} | Ultima Edición: {{$post->updated_at->diffForHumans()}}</p>
        <p>{{$post->content}}</p>
        </div>
{{--Commnets--}}
        <div class="container">
            <h2>Comentarios</h2>

            @auth
        <form action="{{route("posts.comments.store",$post->id)}}" method="post" class="comentarios">
                {{ csrf_field() }}
                <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Escribe aqui tu comentario"></textarea><br>
                <button type="submit" class="btn btn-primary">Publicar <i class="fas fa-paper-plane"></i></button>
            </form>
            @error('comment')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @endauth
            @guest
            <h4>Para comentar por favor inicia sessión </h4><a class="btn btn-primary" href="/login">Iniciar Sessión</a>
            @endguest

            <br>

            @forelse ($post->comments as $comment)
            @php $counter = 0;
                $button = 0;
            @endphp
                <div class="coment">
                <p>{{$comment->comment}}</p>

                @forelse ($post->likes as $like)

                @if($like->comment_id == $comment->id)
                    @php $counter ++ @endphp
                        @auth
                        @if($like->user_id === auth()->user()->id)
                            @php 
                            $counter --;
                            $button ++ ;
                            @endphp
                                                @if($button > 0)
                                                <form action="{{route('posts.comments.likes.destroy',[$post->id, $comment->id,$like->id])}}" method="post">
                                                    @method('DELETE')
                                                    {{ csrf_field() }}
                                                    <button class="btn" style="color:#0074DC "><i class="far fa-thumbs-up"></i> Me Gusta</button>
                                                </form>
                                                @endif

                        @endif
                        @endauth
                @endif

                   @empty
                   @php $button = 0 @endphp

                   @endforelse
            @auth

                   @if($button === 0 )
                   <form action="{{route('posts.comments.likes.store',[$post->id, $comment->id])}}" method="post">
                       {{ csrf_field() }}
                           <button class="btn" style="color:#6C6C6C "><i class="far fa-thumbs-up"></i> Me Gusta</button>
                       </form>
                       @endif
            @endauth
                <p class="btn" style="cursor: default;">@if($button > 0) Tu y @endif{{$counter}} Personas deieron Me gusta a este comentario</p>

                @auth
                @if($comment->user_id == auth()->user()->id)
                    <form action="{{route('posts.comments.destroy',[$post->id, $comment->id])}}" method="post">
                        @method('DELETE')
                        {{ csrf_field() }}
                    <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar Comentario</button>
                </form>
                @endif
                @endauth
                    <p><b>Creado por:{{$comment->user_name}} {{$comment->created_at->diffForHumans()}}</b> | Ultima edición: {{$comment->updated_at->diffForHumans()}}</p>
                </div>
            @empty
                <div class="coment">
                    <p>No hay comentarios se el primero en hacerlo</p>
                </div>
            @endforelse
            
</body>
</html>
@endsection