<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Pokemon API</title>
</head>
<body>
    <h3>Introduce el nombre del pokemon que quieres buscar.<br>
    Si no sabes cuál quieres, pulsa el botón. Se te mostrarán<br>
    varios para elegir</h3>
    <form method="get">
        <label for="Nombre"></label>
        <input name="nombre">
        <button type="submit" name="button">Enviar</button>
    </form>
</body>
</html>

<?php
    if (isset($_GET['button'])){
        if ($_GET['nombre']!=""){
            $nombre = $_GET['nombre'];
            header("Location: datosPokemon.php?pokemon=$nombre");
        }else{
            echo "<h1>Pokemon disponibles</h1>";
            $url = "https://pokeapi.co/api/v2/pokemon?limit=20";
            $json = file_get_contents($url);
            $datosPokemon = json_decode($json,true);
            echo "<div id='zonaPokemon'>";
            foreach ($datosPokemon ['results'] as $pokemon){
                //obtenemos los detalles del pokemon
                $detailsPokemonJson = file_get_contents($pokemon['url']);
                $detailsPokemon = json_decode($detailsPokemonJson,true);
                echo "<div id='pokemon'>";
                echo "<img src='".$detailsPokemon['sprites']['front_default']."'>";
                echo "<h2><a href='datosPokemon.php?pokemon=" . $pokemon['name'] . "'>" . $pokemon['name'] . "</a> </h2><br>";
                echo "</div>";
            }
            echo "</div>";
        }
    }

?>