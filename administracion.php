<?php
include 'db.php';
session_start();

// Modo Oscuro
$tema = $_SESSION['tema'] ?? 'claro';

//Conexion a la base de datos y traemos los productos
$sql = "SELECT * FROM producto";
$result = $conn->query($sql);

$items = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/botones.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/tema.css">
    <link rel="stylesheet" href="css/tarjetas.css">
    <link rel="stylesheet" href="css/administracion.css">
    <title>Administración</title>
</head>

<body class="<?= $tema ?>">

    <?php include("header.php"); ?>

    <main class="main">

        <h1>Administración de Productos</h1>

        <button id="btnNuevo" class="button-form">+ Nuevo Producto</button>

        <!-- MODAL oculto -->
        <div id="modal" class="modal modal-administracion" style="display:none;">
            <form id="formProducto" class="form-modal-administracion">
                <input type="hidden" id="id">
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" id="titulo" required>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <select id="categoria" required>

                        <option value="">Seleccionar categoría</option>
                        <option value="Teclado">Teclado</option>
                        <option value="Auriculares">Auriculares</option>
                        <option value="Mouse">Mouse</option>
                        <option value="Volante">Volante</option>

                    </select>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" id="descripcion" required>
                </div>

                <div class="form-group">
                    <label for="archivo">Imagen</label>
                    <input type="file" id="archivo" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="button-form">Guardar</button>
                    <button type="button" id="cerrarModal" class="button-form">Cancelar</button>
                </div>
            </form>
        </div>

        <!-- LISTADO DE ITEMS -->
        <div class="tarjeta-listado">
            <?php foreach ($items as $item): ?>
                <div class="tarjeta">
                    <p> ID <?= $item["id"] ?></p>
                    <img src="<?= $item["imagen"] ?>" alt="<?= $item["titulo"] ?>">
                    <p><?= $item["descripcion"] ?></p>
                    <h3><?php echo $item["titulo"]; ?></h3>
                    <span><?php echo $item["categoria"]; ?></span>
                    <button 
                        class="button-administracion-editar"
                        onclick="editar(<?= $item['id'] ?>)">
                        Editar
                    </button>

                    <button 
                        class="button-administracion-eliminar"
                        onclick="eliminar(<?= $item['id'] ?>)">
                        Eliminar
                    </button>
                </div>
            <?php endforeach; ?>
        </div>


    </main>
    <script src="JS/administracion/modal.js"></script>
    <?php include("footer.php"); ?>