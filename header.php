 <?php

$tema_actual = $_SESSION['tema'] ?? 'claro';
$tema_opuesto = $tema_actual === 'oscuro' ? 'claro' : 'oscuro';
?> 

    <header class="header" >

        <a href="index.php">
            <img src="img/Logitech-Logo-2.png" alt="Logo" class="logo">
        </a>
        <nav class="nav">
            <a href="index.php" class="button">Inicio</a>
            <a href="categorias.php" class="button">Categorias</a>
            <a href="administracion.php" class="button">Administración</a>
            <a href="api.php" class="button">API</a>
            <a href="tema.php?tema=<?= $tema_opuesto ?>" class="button">
                Cambiar a <?= ucfirst($tema_opuesto) ?>
            </a>

        </nav>

    </header>


