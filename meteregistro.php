<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/StyleSinRegistro.css">
    <title>Document</title>
</head>
<body>

<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perrera";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Insertar registros de prueba en la tabla de personas
$sql_insert_personas = "INSERT INTO personas (nombre, telefono) VALUES
    ('Juan Pérez', '555-1234'),
    ('María López', '555-5678'),
    ('Pedro Rodríguez', '555-9876')";

if ($conn->query($sql_insert_personas) === TRUE) {
    echo "Registros de prueba de personas insertados con éxito";
} else {
    echo "Error al insertar registros de personas: " . $conn->error;
}

// Obtener los ID de las personas insertadas
$id_juan = $conn->insert_id; // ID de Juan Pérez
$id_maria = $id_juan + 1;   // ID de María López
$id_pedro = $id_maria + 1;  // ID de Pedro Rodríguez

// Insertar registros de prueba en la tabla de gatos
$sql_insert_gatos = "INSERT IGNORE INTO gatos (gato, id_persona) VALUES
    ('Minino', $id_juan),
    ('Garfield', $id_maria),
    ('Pelusa', NULL)";

if ($conn->query($sql_insert_gatos) === TRUE) {
    echo "Registros de prueba de gatos insertados con éxito<br>";
} else {
    echo "Error al insertar registros de gatos: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
</body>
</html>