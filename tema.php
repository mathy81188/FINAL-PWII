<?php

session_start();

// Verificamos si llega el parametro ?tema=oscuro o ?tema=claro
if(isset($_GET['tema']) && in_array($_GET['tema'], ['oscuro', 'claro'])){
    $_SESSION['tema'] = $_GET['tema']; //Si lo encuentra, lo guardia en la sesion
}

// Redirigir de vuelta a la página anterior (referer) o a index.php por defecto
$pagina = $_SERVER['HTTP_REFERER'] ?? 'index.php'; // Buscamos desde que URL venimos, si no existe volvemos al index
header("Location: $pagina"); // Le decimos al navegador que se rediriga a esa URL
exit; //Finalizamos la ejecucion

?>