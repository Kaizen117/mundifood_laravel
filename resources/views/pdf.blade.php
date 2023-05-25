<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menú Mundifood</title>   
 </head>
 <body>
    
    <label style="float: left; font-weight: bold; font-style: italic;">MundiF00d</label>
    <h1 style="text-align: center; background-color: #800000; color: white; font-weight: bold;">Nuestra carta</h1>    
    <div id="logo" style="text-align: center;">
        <img src="https://crystal.ph/wp-content/uploads/2022/01/Logo.jpg" alt="Logo de la empresa" style="width: 150px; height: 150px;">
        <p style="font-size: 20px; font-weight: bold; color: black;">¡Cómete el mundo!</p>
    </div>
    
    <div class="container mt-5">        
        <h1 style="text-align: center; background-color: #800000; color: white; font-weight: bold;">Entrantes</h1>
        <table class="table table-bordered mb-5" style="width:100%;">                
            <tbody>
                @foreach($dishesEntrantes as $dishE) 
                    <tr>
                        <td style="text-align: center;">
                            <img src="{{'images/dishes/'.$dishE->image }}" alt="{{ $dishE->name }}" style="width: 180px; height: 150px;">
                        </td>
                        <td style="text-align: center; color: gray; width: 150px;">{{ $dishE->name }}</td>
                        <td style="text-align: center; color: gray; width: 200px;">{{ $dishE->description }}</td>
                        <td style="text-align: center; color: gray; width: 50px; font-weight: bold;">{{ $dishE->price }}€</td>                            
                        @if($dishE->disponibility==0)
                            <td style="text-align: center; color: red; width: 100px; font-weight: bold;">
                                No disponible
                            </td>
                        @endif                            
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container mt-5">            
        <h1 style="text-align: center; background-color: #800000; color: white; font-weight: bold;">Sopas</h1>
        <table class="table table-bordered mb-5" style="width:100%;">                
            <tbody>
                @foreach($dishesSoups as $dishS)
                    <tr>
                        <td style="text-align: center;">
                            <img src="{{'images/dishes/'.$dishS->image }}" alt="{{ $dishS->name }}" style="width: 180px; height: 150px;">
                        </td>
                        <td style="text-align: center; color: gray; width: 150px;">{{ $dishS->name }}</td>
                        <td style="text-align: center; color: gray; width: 200px;">{{ $dishS->description }}</td>
                        <td style="text-align: center; color: gray; width: 50px; font-weight: bold;">{{ $dishS->price }}€</td>                            
                        @if($dishS->disponibility=0)
                            <td style="text-align: center; color: red; width: 100px; font-weight: bold;">
                                No disponible
                            </td>
                        @endif                            
                    </tr>
                @endforeach        
            </tbody>
        </table>
    </div>

    <div class="container mt-5">
        <h1 style="text-align: center; background-color: #800000; color: white; font-weight: bold;">Carnes</h1>
        <table class="table table-bordered mb-5" style="width:100%;">                
            <tbody>
                @foreach($dishesMeats as $dishM)
                    <tr>
                        <td style="text-align: center;">
                            <img src="{{'images/dishes/'.$dishM->image }}" alt="{{ $dishM->name }}" style="width: 180px; height: 150px;">
                        </td>
                        <td style="text-align: center; color: gray; width: 150px; ">{{ $dishM->name }}</td>
                        <td style="text-align: center; color: gray; width: 200px; ">{{ $dishM->description }}</td>
                        <td style="text-align: center; color: gray; width: 50px; font-weight: bold;">{{ $dishM->price }}€</td>                            
                        @if($dishM->disponibility==0)
                            <td style="text-align: center; color: red; width: 100px; font-weight: bold;">
                                No disponible
                            </td>
                        @endif                                                                         
                    </tr>
                @endforeach                    
            </tbody>
        </table>
    </div>

    <div class="container mt-5">           
        <h1 style="text-align: center; background-color: #800000; color: white; font-weight: bold;">Pescados</h1>
        <table class="table table-bordered mb-5" style="width:100%;">                
            <tbody>
                @foreach($dishesFish as $dishF) 
                    <tr>
                        <td style="text-align: center;">
                            <img src="{{'images/dishes/'.$dishF->image }}" alt="{{ $dishF->name }}" style="width: 180px; height: 150px;">
                        </td>
                        <td style="text-align: center; color: gray; width: 150px; ">{{ $dishF->name }}</td>
                        <td style="text-align: center; color: gray; width: 200px; ">{{ $dishF->description }}</td>
                        <td style="text-align: center; color: gray; width: 50px; font-weight: bold;">{{ $dishF->price }}€</td>                            
                        @if($dishF->disponibility==0)
                            <td style="text-align: center; color: red; width: 100px; font-weight: bold;">
                                No disponible
                            </td>
                        @endif                            
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>    

    <div class="container mt-5">            
        <h1 style="text-align: center; background-color: #800000; color: white; font-weight: bold;">Bebidas</h1>
        <table class="table table-bordered mb-5" style="width:100%;">                
            <tbody>
                @foreach($dishesDrinks as $dishD) 
                    <tr>
                        <td style="text-align: center;">
                            <img src="{{'images/dishes/'.$dishD->image }}" alt="{{ $dishD->name }}" style="width: 180px; height: 150px;">                                </td>
                        <td style="text-align: center; color: gray; width: 150px; ">{{ $dishD->name }}</td>
                        <td style="text-align: center; color: gray; width: 200px; ">{{ $dishD->description }}</td>
                        <td style="text-align: center; color: gray; width: 50px; font-weight: bold;">{{ $dishD->price }}€</td>                            
                        @if($dishD->disponibility==0)
                            <td style="text-align: center; color: red; width: 100px; font-weight: bold;">
                                No disponible
                            </td>
                        @endif                            
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container mt-5">            
        <h1 style="text-align: center; background-color: #800000; color: white; font-weight: bold;">Postres</h1>
        <table class="table table-bordered mb-5" style="width:100%;">                
            <tbody>
                @foreach($dishesDesserts as $dishDes) 
                    <tr>
                        <td style="text-align: center;">
                            <img src="{{'images/dishes/'.$dishDes->image }}" alt="{{ $dishDes->name }}" style="width: 180px; height: 150px;">                                </td>
                        <td style="text-align: center; color: gray; width: 150px; ">{{ $dishDes->name }}</td>
                        <td style="text-align: center; color: gray; width: 200px; ">{{ $dishDes->description }}</td>
                        <td style="text-align: center; color: gray; width: 50px; font-weight: bold;">{{ $dishDes->price }}€</td>                            
                        @if($dishDes->disponibility==0)
                            <td style="text-align: center; color: red; width: 100px; font-weight: bold;">
                                No disponible
                            </td>
                        @endif                            
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="container mt-5">        
        <h1 style="text-align: center; background-color: #800000; color: white; font-weight: bold;">Vinos</h1>
        <table class="table table-bordered mb-5" style="width:100%;">                
            <tbody>
                @foreach($dishesWines as $dishW) 
                    <tr>
                        <td style="text-align: center;">
                            <img src="{{'images/dishes/'.$dishW->image }}" alt="{{ $dishW->name }}" style="width: 180px; height: 150px;">
                        </td>
                        <td style="text-align: center; color: gray; width: 150px; ">{{ $dishW->name }}</td>
                        <td style="text-align: center; color: gray; width: 200px; ">{{ $dishW->description }}</td>
                        <td style="text-align: center; color: gray; width: 50px; font-weight: bold;">{{ $dishW->price }}€</td>                            
                        @if($dishW->disponibility==0)
                            <td style="text-align: center; color: red; width: 100px; font-weight: bold;">
                                No disponible
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="container mt-5">
        <h1 style="text-align: center; background-color: #800000; color: white; font-weight: bold;">Otros</h1>
        <table class="table table-bordered mb-5" style="width:100%;">
            <tbody>
                @foreach($dishesOthers as $dishO) 
                    <tr>
                        <td style="text-align: center;">
                            <img src="{{'images/dishes/'.$dishO->image }}" alt="{{ $dishO->name }}" style="width: 180px; height: 150px;">
                        </td>
                        <td style="text-align: center; color: gray; width: 150px; ">{{ $dishO->name }}</td>
                        <td style="text-align: center; color: gray; width: 200px; ">{{ $dishO->description }}</td>
                        <td style="text-align: center; color: gray; width: 50px; font-weight: bold;">{{ $dishO->price }}€</td>
                        @if($dishO->disponibility==0)
                            <td style="text-align: center; color: red; width: 100px; font-weight: bold;">
                                No disponible
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>         
    </div>
 </body>
</html>