<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div class="container">
        <h1>Editar Blog</h1>
<form action="{{route('posts.update',$post->id)}}" method="post">
        <div class="form-group">
            @method('PATCH')
            {{ csrf_field() }}
          <label for="exampleInputEmail1">Titulo</label>
          <input type="text" class="form-control"  name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titulo del Blog" value="{{$post->title}}">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Contenido del Blog</label>
          <textarea type="text" name="content" class="form-control" id="exampleInputPassword1" placeholder="Contenido" value="{{$post->content}}">{{$post->content}}</textarea>
        </div>
        <div class="form-group">
            <label for="img">Imagen</label>
            <input type="text" class="form-control"  name="url_img" id="img" aria-describedby="emailHelp" placeholder="Url de la imagen" value="{{$post->url_img}}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </form>
    </div>
</body>
</html>