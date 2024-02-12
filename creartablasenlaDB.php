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

// Crear tabla de personas
$sql_personas = "CREATE TABLE IF NOT EXISTS personas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    telefono VARCHAR(15) NOT NULL
)";

if ($conn->query($sql_personas) === TRUE) {
    echo "Tabla de personas creada con éxito<br>";
} else {
    echo "Error al crear la tabla de personas: " . $conn->error;
}

// Crear tabla de gatos
$sql_gatos = "CREATE TABLE IF NOT EXISTS gatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gato VARCHAR(50) NOT NULL,
    id_persona INT,
    FOREIGN KEY (id_persona) REFERENCES personas(id)
)";

if ($conn->query($sql_gatos) === TRUE) {
    echo "Tabla de gatos creada con éxito<br>";
} else {
    echo "Error al crear la tabla de gatos: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
