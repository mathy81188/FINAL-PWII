<?php

include 'db.php';
session_start(); //Iniciamos la sesion

//Conexion a la base de datos y traemos los productos
$sql = "SELECT * FROM producto";
$result = $conn->query($sql);

$items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

// Mezclar y elegir 4 productos
shuffle($items);
$items_aleatorios = array_slice($items, 0, 4);

//Modo Oscuro
$tema = $_SESSION['tema'] ?? 'claro'; //Verifica que tema se esta utilizando, si no hay tema aplica el blanco
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logitech</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/tarjetas.css">
    <link rel="stylesheet" href="css/botones.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/tema.css">
</head>

<body class="<?= $_SESSION['tema'] ?? 'claro' ?>">

    <?php include("header.php"); ?>

    <main class="main">

        <div class="banner">
            <img src="img/Logitech-banner-1.webp" alt="Banner Logitech" class="img-banner">
        </div>

        <h1>Nuestros Productos Destacados</h1>
        <div class="catalogo">

            <?php foreach ($items_aleatorios as $item): ?>
                <div class="tarjeta">
                    <img src="<?= $item["imagen"] ?>" alt="<?= $item["titulo"] ?>">
                    <p><?= $item["descripcion"] ?></p>
                    <h2><?php echo $item["titulo"]; ?></h2>
                    <span><?php echo $item["categoria"]; ?></span>
                </div>
            <?php endforeach; ?>

        </div>
    </main>

    <?php include("footer.php"); ?>

</body>

</html>