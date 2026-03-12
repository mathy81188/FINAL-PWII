<?php
header("Content-Type: application/json");
require "db.php";

$method = $_SERVER["REQUEST_METHOD"];

$input = json_decode(file_get_contents("php://input"), true);

if ($method === "GET") {

    $categoria = $_GET["categoria"] ?? "";
    $buscar = $_GET["buscar"] ?? "";

    $sql = "SELECT * FROM producto WHERE 1=1";

    if ($categoria !== "") {
        $categoria = $conn->real_escape_string($categoria);
        $sql .= " AND categoria = '$categoria'";
    }

    if ($buscar !== "") {
        $buscar = $conn->real_escape_string($buscar);
        $sql .= " AND titulo LIKE '%$buscar%'";
    }

    $result = $conn->query($sql);

    $productos = [];

    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }

    echo json_encode($productos);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST["method"] === "POST_NEW" || $_POST["method"] === "POST_EDIT") {

        $id = $_POST["id"] ?? "";
        $titulo = $conn->real_escape_string($_POST["titulo"]);
        $categoria = $conn->real_escape_string($_POST["categoria"]);
        $descripcion = $conn->real_escape_string($_POST["descripcion"]);

        $rutaImagen = "";

        if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] === 0) {

            $nombre = uniqid() . "_" . basename($_FILES["archivo"]["name"]);
            $destino = "img/" . $nombre;

            move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino);

            $rutaImagen = $destino;
        }

        if ($_POST["method"] === "POST_NEW") {

            $sql = "INSERT INTO producto (titulo, categoria, descripcion, imagen)
                    VALUES ('$titulo', '$categoria', '$descripcion', '$rutaImagen')";

            $conn->query($sql);
            echo json_encode(["success" => true]);
            exit;
        }

        if ($_POST["method"] === "POST_EDIT") {

            $sql = "UPDATE producto SET 
                titulo='$titulo',
                categoria='$categoria',
                descripcion='$descripcion'" .
                ($rutaImagen ? ", imagen='$rutaImagen'" : "") .
                " WHERE id=$id";

            $conn->query($sql);

            echo json_encode(["success" => true]);
            exit;
        }
    }
}

if ($method === "PUT") {

    if (!$input) {
        echo json_encode(["error" => "JSON inválido"]);
        exit;
    }

    $id = intval($input["id"]);
    $titulo = $conn->real_escape_string($input["titulo"]);
    $categoria = $conn->real_escape_string($input["categoria"]);
    $descripcion = $conn->real_escape_string($input["descripcion"]);
    $imagen = $conn->real_escape_string($input["imagen"]);

    $sql = "UPDATE producto SET 
            titulo='$titulo', 
            categoria='$categoria', 
            descripcion='$descripcion',
            imagen='$imagen'
            WHERE id=$id";

    if ($conn->query($sql)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => $conn->error]);
    }

    exit;
}

if ($method === "DELETE") {

    if (!$input || !isset($input["id"])) {
        echo json_encode(["error" => "ID no enviado"]);
        exit;
    }

    $id = intval($input["id"]);

    $sql = "SELECT imagen FROM producto WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rutaImagen = $row["imagen"]; 

        
        if (file_exists($rutaImagen)) {
            unlink($rutaImagen);
        }
    }

    $sql = "DELETE FROM producto WHERE id = $id";

    if ($conn->query($sql)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => $conn->error]);
    }

    exit;
}

echo json_encode(["error" => "Método no soportado"]);
 ?>