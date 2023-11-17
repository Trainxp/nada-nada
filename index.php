<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');
$fechaActual = date("d/m/Y");
$url = "https://dolarapi.com/v1/dolares/blue";
$response = file_get_contents($url);
$cotizacionFinal=0;

if ($response === false) {
    // Manejo de errores si la solicitud falla
    echo "Error al obtener datos de la API.";
} else {
    // Decodificar la respuesta JSON
    $data = json_decode($response);

    $fecha = $data->fechaActualizacion;
    $fechaFormateada = date("d/m/Y H:i", strtotime($fecha));


    // Verificar si la decodificación fue exitosa
    if ($data !== null) {
        // Mostrar los datos dentro de un div
        echo '<div class = caja >';
        echo '<p class =verde >Compra: ' . $data->compra . '</p>';
        echo '<p class =verde >Venta: ' . $data->venta . '</p>';
        echo '<p class =azul >Casa: ' . $data->casa . '</p>';
        echo '<p class =azul >Nombre: ' . $data->nombre . '</p>';
        echo '<p class =amarillo >Moneda: ' . $data->moneda . '</p>';
        echo '<p>Fecha de Actualización: ' . $fechaFormateada . '</p>';
        echo '</div>';
    } else {
        echo "Error al decodificar los datos JSON.";
    }
}

if($_POST){
       
  $cantidadPesos= $_POST["cantidad"]; 
  $numeroSoloDigitos = preg_replace("/[^0-9]/", "", $cantidadPesos);
  $cantidadPesosFinal =$numeroSoloDigitos;
  
  $cotizacion= $cantidadPesosFinal/$data->venta;
  $cotizacionFinal=  round($cotizacion, 2);
//echo  "<p class =hola > $cotizacionFinal  </p>";
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <style>
        .hola{
            z-index: 2;
            margin: 0 auto;
            margin-top: 200px;
            color:white;
            background-color:black;
            max-width: 20em;
            }

        .caja{
            display:flex;
            margin : 0 auto;
            border-radius: 15px;
            width: 75%;
            background-color: black;
            color:white;
            font-size:1.4em;

            
    }    
    .caja p{
        padding: 20px;
    }

    .verde{
        color:green;
    }

    .verde2{
        color:green;
        margin-top:-10px;
        font-weight: 600;
        padding-left:5em;
        font-size:1.3em;
    }

    .azul{
        color:blue;
    }
    .amarillo{
        color:yellow;
    }


    .formulario{
        display: flex;
        margin: 0 auto;
        align-content: space-around;
        flex-direction: column;
        flex-wrap: wrap;
    }
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@1,500&display=swap');

    .TituloForm{
        font-family: 'Roboto Condensed', sans-serif;   
    }
    body {
    background-color: #e0d8c8; /* o cualquier otro tono de gris oscuro */
    }
   
    .hechoPor{
        position: fixed;
        display: flex;
        align-items: center;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 300px; /* Ancho del div */
        background-color: #f2f2f2;
        padding: 5px;
        text-align: center;
        height:20px;

    }

    .version{
        font-size:.8em;
        margin-left:20px;
    }

    </style>

    <hr>
    <div class="formulario">
        <form  action="index.php" method="post">

        <h1 class ="TituloForm" >Ingrese la cantidad en pesos a convertir:</h1>
        <span>$</span>  <input type="text" name="cantidad" id=""  placeholder="Ingrese monto en pesos Arg"  style="width: 200px;" >
        <button type="submit">Convertir</button>



        </form>    
    </div>
    
    <?php
    //if($cotizacionFinal==null){ $cotizacionFinal=0};
    echo  "<div class =hola > <p> El valor final  en dia de la fecha  $fechaActual es: <p class =verde2 > USD:  $cotizacionFinal</p> </p>   </div>"          ?>

    <div class="hechoPor" >   <h6>Hecho por Cristian Nahuel Enriquez </h6>   <p class = "version">version: 1.0</p>  </div>
</body>
</html>



