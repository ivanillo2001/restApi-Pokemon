<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Datos Pokemon</title>
</head>
<body>
<?php
    if (isset($_GET['pokemon'])){
        try {
            $nombre = $_GET['pokemon'];
            $url = "https://pokeapi.co/api/v2/pokemon/$nombre";
            $json = file_get_contents($url);
            //verificamos si existe el pokemon:
            if ($json===false){
                throw new Exception("Error al obtener datos del Pokémon");
            }
            $datosPokemon = json_decode($json,true);

            // Verifica si la decodificación del JSON fue exitosa
            if ($datosPokemon === null) {
                throw new Exception("Error al decodificar datos del Pokémon");
            }
            echo "<img src='".$datosPokemon['sprites']['front_default']."'>"; //front_default es la imagen a la que hacemos referencia
            echo "<ul>";
            echo "<li>Nombre: ".$datosPokemon['name']."</li>";
            echo "<li>Altura: ".$datosPokemon['height']."</li>";
            echo "<li>Peso: ".$datosPokemon['weight']."</li>";
            echo "</ul>";
            echo "<h2>Habilidades</h2>";
            echo "<ul>";
            foreach ($datosPokemon['abilities'] as $habilidad){
                echo "<li>".$habilidad['ability']['name']."</li>";
            }
            echo"</ul>";
            echo "<h2>types:</h2>";
            foreach ($datosPokemon['types'] as $type){
                echo $type['type']['name'];//accedemos a su tipo de pokemon
            }
        }catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }
?>
</body>
</html>