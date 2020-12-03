@extends('layouts.app')

@section('content')
    <div style="margin: 5% 10%">
        <center><h1>Servidor Local</h1></center>
        <form action="{{route('carpeta')}}" method="post">
            <legend>Agregar Carpeta</legend>
            <div class="form-group">
                <input type="text" name="nombre" required>
                <button type="submit"><i class="fa fa-plus"></i>Agregar</button>
            </div>
            @csrf
        </form>
        <form action="{{route('archivo')}}" method="post" enctype="multipart/form-data">
            <legend>Subir Archivo</legend>
            <div class="form-group">
                <input type="file" id="files" name="archivos[]" multiple required>
                <button type="submit"><i class="fa fa-plus"></i>Agregar</button>
            </div>
            @csrf
        </form>
        @if ($message = Session::get('message-alert'))
            <div class="alert alert-warning">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('message-success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <br/>
        <div id="lista_imagenes"></div>
        <script>
            function archivo(evt) {
                var files = evt.target.files; // FileList object

                // Obtenemos la imagen del campo "file".
                for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                        continue;
                    }

                    var reader = new FileReader();

                    reader.onload = (function(theFile) {
                        return function(e) {
                        // Insertamos la imagen
                    var respaldo=document.getElementById("lista_imagenes").innerHTML;
                        document.getElementById("lista_imagenes").innerHTML =respaldo+['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/ style="width: 8%">'].join('');
                        };
                    })(f);

                    reader.readAsDataURL(f);
                }
            }

            document.getElementById('files').addEventListener('change', archivo, true);
        </script>
    </div>
@endsection
