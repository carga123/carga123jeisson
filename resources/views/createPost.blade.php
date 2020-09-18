<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Nuevo Blog</title>

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
        <h1>Crear nuevo Blog</h1>
    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            {{ csrf_field() }}
          <label for="exampleInputEmail1">Titulo</label>
          <input type="text" class="form-control"  name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Titulo del Blog">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Contenido del Blog</label>
          <textarea type="text" name="content" class="form-control" id="exampleInputPassword1" placeholder="Contenido"></textarea>
        </div>
        <div class="form-group">
          <label for="ejemplo_archivo_1">Adjuntar un imagen</label>
          <input type="file" id="ejemplo_archivo_1" name="url_img">
        </div>
        <button type="submit" class="btn btn-primary">Crear Blog</button>
      </form>
    </div>


</body>
</html>