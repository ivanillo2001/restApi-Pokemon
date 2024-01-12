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
            echo "<table id='tablaDatos'>";
            echo "<tr>";
                echo "<td><h2>Nombre:</h2></td>";
                echo "<td><h3>".$datosPokemon['name']."</h3></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><h2>Altura:</h2></td>";
            echo "<td><h3>".$datosPokemon['height']."</h3></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><h2>Peso:</h2></td>";
            echo "<td><h3>".$datosPokemon['weight']."</h3></td>";
            echo "</tr>";
            echo "<table>";

            echo "<h2>Abilities</h2>";
            echo "<div id='habilidades'>";
            foreach ($datosPokemon['abilities'] as $habilidad){
                echo "<h3>".$habilidad['ability']['name']."</h3><br>";
            }
            echo"</div>";

            echo "<h2>types:</h2>";
            echo "<div id='types'>";
            foreach ($datosPokemon['types'] as $type){
                echo "<h3>".$type['type']['name']."</h3><br>";//accedemos a su tipo de pokemon
            }
            echo "</div>";
        }catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }
?>
</body>
</html>