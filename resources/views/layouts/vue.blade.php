<!DOCTYPE html>
<html>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('semantic/semantic.min.css') }}" rel="stylesheet">
    <link href="{{ asset('hey/app.css') }}" rel="stylesheet">

</head>
<body>
    <div>
        <div class="appHeader" style="display:flex">
            <div>
            <img class="appLogo" src="https://drive.google.com/thumbnail?id=1m9yAwNX85iPgXF-cdAceU1vI9xzZ4nRf">
            </div>
            <div style="float:right;display:flex;margin-left:auto;margin-top:25px">
                <p style="color:#FFFFFF">${firstname}</p>
                <form action="salir" method="get" style="float:right">
                    <button style="background-color:transparent;border-color:transparent"><i class="sign out inverted alternate icon"></i></button>
                </form>
            </div>
        </div>
        <div class="decorBar"></div>
        @yield("content")
    </div>
</body>
</html>