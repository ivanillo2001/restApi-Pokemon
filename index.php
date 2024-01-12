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
    Si no sabes cuál quieres puedes consultarlos todos <br>
    un poco más abajo. Al hacer click sobre ellos irás <br>
    a la información más relevante de ese pokemon.</h3>
<form method="get">
    <label for="Nombre"></label>
    <input type="hidden" name="page" value="<?= isset($_GET['page']) ? $_GET['page'] : 1 ?>">
    <!--Para indicar la página en la que estamos. Por defecto será 1-->
    <input name="nombre">
    <button type="submit" name="button">Buscar</button>
</form>
</body>
</html>
<?php
if (isset($_GET['nombre'])) {
    if ($_GET['nombre'] != "") {
        $nombre = $_GET['nombre'];
        header("Location: datosPokemon.php?pokemon=$nombre");
        exit();
    }
} else {
    echo "<h1>Pokemon disponibles</h1>";
    // Establecemos la pagina predeterminada como 1 u obtenemos la pagina actual
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    //indicamos el offset segun la página actual:
    $offset = ($page - 1) * 20;

    $url = "https://pokeapi.co/api/v2/pokemon?limit=20&offset=$offset";
    $json = file_get_contents($url);
    $datosPokemon = json_decode($json, true);
    echo "<div id='zonaPokemon'>";
    foreach ($datosPokemon ['results'] as $pokemon) {
        //obtenemos los detalles del pokemon
        $detailsPokemonJson = file_get_contents($pokemon['url']);
        $detailsPokemon = json_decode($detailsPokemonJson, true);
        echo "<div id='pokemon'>";
        echo "<a href='datosPokemon.php?pokemon=" . $pokemon['name'] . "'><img src='" . $detailsPokemon['sprites']['front_default'] . "'></a>";
        echo "<h2>" . $pokemon['name'] . "</h2><br>";
        echo "</div>";
    }
    echo "</div>";
    // Agregamos enlaces de paginación
    echo "<div id='controles'>";

    // Anterior si la página es mayor a 1
    if ($page > 1) {
        echo "<a class='control' href='?page=" . ($page - 1) . "'>Anterior</a>";
    }

    // Siguiente
    echo "<a class='control' href='?page=" . ($page + 1) . "'>Siguiente</a>";
    echo "</div>";
}


?>