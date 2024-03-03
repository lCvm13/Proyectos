<?php
require_once "connection.php";

// Función para obtener todos los usuarios
function getAllUsuarios($pdo) {
    $sql = "SELECT nombre, apellido, ciudad FROM usuarios";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $usuarios;
}

// Verificar si se solicitan todos los usuarios
    $allUsuarios = getAllUsuarios($pdo);
    header('Content-Type: application/json');
    echo json_encode($allUsuarios);
    exit(); // Terminar la ejecución después de enviar la respuesta JSON
?>