<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";

// Crear conexión
$conn = new mysqli($servername, $username, $password);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Nombre de la base de datos que deseas crear
$databaseName = "perrera";

// Crear la base de datos
$sql = "CREATE DATABASE IF NOT EXISTS $databaseName";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos creada con éxito";
} else {
    echo "Error al crear la base de datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
