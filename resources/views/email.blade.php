<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <title>{{ $subject }}</title>
        <style>
            
        </style>
    </head>
    <body>                            
        <div>
            <p>{{ $content }}</p>                        

            {!! $platosHtml !!}            
            
            <h1>{{ $subject }}</h1>            
        </div>                
    </body>
</html>