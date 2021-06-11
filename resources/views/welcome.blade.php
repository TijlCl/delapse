<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Delapse</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>

    <div class="background">
        <form method="GET" action="{{ route('dowbload-delapse-app') }}">
            <button class="button" ref="button"><span>Download now!</span></button>
        </form>
    </div>

    </body>
</html>
