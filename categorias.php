<?php

include "db.php";
session_start(); // Iniciamos la sesion

//Conexion a la base de datos y traemos los productos
$sql = "SELECT * FROM producto";
$result = $conn->query($sql);

$items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}



//Modo Oscuro
$tema = $_SESSION['tema'] ?? 'claro'; // Verifica que tema se esta utilizando, si no hay tema aplica el blanco

// Traemos los parámetros GET
$filtro_categoria = $_GET['categoria'] ?? '';
$busqueda = $_GET['buscar'] ?? '';

// Filtramos los items segun categoria y busqueda
$items_filtrados = array_filter($items, function ($item) use ($filtro_categoria, $busqueda) {
    $cumple_categoria = $filtro_categoria === '' || $item['categoria'] === $filtro_categoria;
    $cumple_busqueda = $busqueda === '' || stripos($item['titulo'], $busqueda) !== false;
    return $cumple_categoria && $cumple_busqueda;
});

// Items sugeridos
$sugerido = null;

// Verificamos si se envio el formulario
$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST['titulo'])) {
        $errores['titulo'] = "El nombre del producto es obligatorio."; // Si nada en "titulo", guardamos el error
    }

    if (empty($_POST['descripcion'])) {
        $errores['descripcion'] = "La descripción es obligatoria.";
    }

    if (empty($_POST['categoria'])) {
        $errores['categoria'] = "La categoría es obligatoria.";
    }

    // Si no hay errores, guardamos la sugerencia
    if (empty($errores)) {
        $sugerido = [
            "titulo" => $_POST['titulo'],
            "descripcion" => $_POST['descripcion'],
            "categoria" => $_POST['categoria']
        ];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/tarjetas.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/botones.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/formulario-recomedar.css">
    <link rel="stylesheet" href="css/categorias.css">
    <link rel="stylesheet" href="css/tema.css">


    <title>Categorias</title>

</head>

<body class="<?= $_SESSION['tema'] ?? 'claro' ?>">

    <?php include("header.php"); ?>

    <main class="main">

        <div class="menu-categorias">

            <!-- FORMULARIO DE FILTRO -->
            <form method="GET" class="filtro-busqueda">

                <button type="submit" name="categoria" value="" class="button-categoria">Todos</button>
                <button type="submit" name="categoria" value="Teclado" class="button-categoria">Teclados</button>
                <button type="submit" name="categoria" value="Auriculares" class="button-categoria">Auriculares</button>
                <button type="submit" name="categoria" value="Volante" class="button-categoria">Volantes</button>
                <button type="submit" name="categoria" value="Mouse" class="button-categoria">Mouses</button>

                <input type="text" name="buscar" placeholder="Buscar por nombre..." value="<?= htmlspecialchars($busqueda) ?>">

                <input type="hidden" name="tema" value="<?= htmlspecialchars($tema) ?>">

            </form>

        </div>

        <!-- LISTADO DE ITEMS -->
        <div class="catalogo">

            <?php if (empty($items_filtrados)): ?>
                <p>No se encontraron productos.</p>

            <?php else: ?>

                <?php foreach ($items_filtrados as $item): ?>

                    <div class="tarjeta">

                        <img src="<?= $item['imagen'] ?>" alt="<?= htmlspecialchars($item['titulo']) ?>">
                        <h3><?= htmlspecialchars($item['titulo']) ?></h3>
                        <p><?= htmlspecialchars($item['descripcion']) ?></p>
                        <span class="categoria"><?= htmlspecialchars($item['categoria']) ?></span>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

        <!-- FORMULARIO DE RECOMENDACION DE PRODUCTO -->
        <div class="formulario-recomendar">

            <h2>¿No encontraste lo que buscabas? Envianos tu recomendación.</h2>

            <form class="formulario-sugerir" method="POST" action="">

                <label for="titulo">Nombre del producto:</label>
                <input type="text" id="titulo" name="titulo" required>
                <?php if (isset($errores['titulo'])): ?>
                    <div class="error"><?= $errores['titulo'] ?></div>
                <?php endif; ?>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>
                <?php if (isset($errores['descripcion'])): ?>
                    <div class="error"><?= $errores['descripcion'] ?></div>
                <?php endif; ?>

                <label for="categoria">Categoría:</label>
                <input type="text" id="categoria" name="categoria" required>
                <?php if (isset($errores['categoria'])): ?>
                    <div class="error"><?= $errores['categoria'] ?></div>
                <?php endif; ?>

                <button type="submit" class="button-sugerir">Sugerir producto</button>

            </form>
            <?php if ($sugerido): ?>

                <div class="confirmacion">
                    <strong>¡Gracias por tu sugerencia!</strong><br>
                    <b>Nombre:</b> <?= $sugerido['titulo'] ?><br>
                    <b>Descripción:</b> <?= $sugerido['descripcion'] ?><br>
                    <b>Categoría:</b> <?= $sugerido['categoria'] ?>

                </div>

            <?php endif; ?>

        </div>
    </main>

    <?php include("footer.php"); ?>

</body>

</html>