<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Actividades</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">


    </head>
    <body style="background-color: #d1d1d1;">
        <div id="app">
            <router-view></router-view>
        </div>
    </body>
    <script src="{{ mix('/js/app.js') }}"></script>
</html>
