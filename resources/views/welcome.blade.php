<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Escollera</title>
        <link rel="icon" sizes="64x64" href="{{ asset('images/favicon.ico') }}">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
        <style>
            body{
                background-color: #0000FF;
                background: linear-gradient(to right,#082a7a,#5179d6);
            }
            .bg{
                background-image:url("https://previews.123rf.com/images/natuskadpi/natuskadpi1701/natuskadpi170100042/70133428-patr%C3%B3n-sin-fisuras-con-picas-verdes-fondo-de-pantalla-con-peces-de-r%C3%ADo-ilustraci%C3%B3n-vectorial.jpg");
                background-position: center center;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="container w-75 bg-primary mt-5 shadow">
            <div class="row align-items-stretch">
                <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6">
                
                </div>
                <div class="col bg-white">
                    <div class="text-center">
                        <img class="py-2" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRRMjiwG9VWb530KHv-6_GX7qNRb7iJDPy3YNSLetgTAOHPySiBKMMZCZS4f_y5JDElA1Y&usqp=CAU"  width="190" alt="Logo Escollera">
                    </div>
                    <form action="#" class="m-2">
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="row justify-content-between py-5">
                            <div type="button" class="btn col-sm-4"><a href="#">¿No tienes cuenta?</a></div>
                            <button type="submit" class="btn btn-primary col-sm-6">Ingresar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
