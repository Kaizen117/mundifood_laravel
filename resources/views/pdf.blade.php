<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Carta Mundif00d</title>
 </head>
 <body>
    <img src="https://pbs.twimg.com/profile_images/670028881433223169/-238O4YW_400x400.png" alt="logotipo de la empresa" style="height: 100px">
    <label style="float: right">MundiF00d</label>
    <div class="col-lg-12 col-md-12 col-sm-12"></div>
    <h2 style="text-align: center">Carta</h2>
    <div style="background-color: 6C934F; height: 12px"></div>
    <br>
    <div class="container mt-5">
        <table class="table table-bordered mb-5" style="border: 3px solid black">
            <thead>
                <tr class="table-danger" style="background-color: BBFE89">
                    <th scope="col" style="border: 1px solid black">#</th>
                    <th scope="col" style="border: 1px solid black">Nombre</th>
                    <th scope="col" style="border: 1px solid black">Descripción</th>                
                    <th scope="col" style="border: 1px solid black">Precio</th>                 
                </tr>
            </thead>
            <tbody>
                @foreach($dishes as $dish)                                  
                    <tr>
                        <th scope="row" style="border: 1px solid black; background-color: 89F5FE">{{ $dish->id }}</th>
                        <td style="border: 1px solid black; background-color: FFEB23">{{ $dish->image }}</td>
                        <td style="border: 1px solid black; background-color: 89F5FE">{{ $dish->name }}</td>
                        <td style="border: 1px solid black; background-color: FFEB23">{{ $dish->description }}</td>
                        <td style="border: 1px solid black; background-color: FFEB23">{{ $dish->price }}</td>
                    </tr>                    
                @endforeach
            </tbody>
        </table>
    </div>
 </body>
</html>