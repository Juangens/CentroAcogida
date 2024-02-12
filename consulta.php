<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styleConsulta.css">
    <title>Document</title>
</head>
<body>
    
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perrera";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Verificar si se ha proporcionado el nombre del gato
    if (isset($_GET["gato"])) {
        $nombreGato = $_GET["gato"];

        // Conectar a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
        }

        // Consulta para verificar si el gato existe
        $sql = "SELECT * FROM gatos WHERE gato = '$nombreGato'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // El gato existe en la base de datos
            $row = $result->fetch_assoc();
            $dueñoId = $row["id_persona"];
            if ($dueñoId == null) {
                // El gato no tiene dueño registrado
                echo "NO HAY DUEÑO REGISTRADO para el animalito <strong> $nombreGato </strong> <br>";
                echo "<a href='./indexconsulta.html'><button>Volver al inicio</button></a>";
            } else {
                // El gato tiene dueño
                $sqlDueño = "SELECT * FROM personas WHERE id = $dueñoId";
                $resultDueño = $conn->query($sqlDueño);

                if ($resultDueño->num_rows > 0) {
                    // Dueño encontrado
                    $rowDueño = $resultDueño->fetch_assoc();
                    $nombreDueño = $rowDueño["nombre"];
                    $telefonoDueño = $rowDueño["telefono"];
                    echo "Connected successfully <br>";
                    echo "DUEÑO <strong> $nombreDueño </strong> EL TELEFONO ES <strong> $telefonoDueño </strong> <br>";
                    echo "<a href='./indexconsulta.html'><button>Volver al inicio</button></a>";
                } else {
                    // El gato tiene un dueño registrado que no existe en la base de datos 
                    echo "ERROR: El animalito tiene un dueño registrado que no existe en la base de datos. <br>";
                    echo "<a href='./indexconsulta.html'><button>Volver al inicio</button></a>";
                }
            }
        } else {
            // El gato no existe en la base de datos
            echo "NO HAY AMINALITO REGISTRADO CON EL NOMBRE DE <strong> $nombreGato </strong> <br> ¿DESEA GUARDARLO? <br> EN ESE CASO ACUDA A <a href='registro.html'> La ventana de registro </a> <br> CASO DE NO QUERER REGISTRARLO <br> <a href='indexconsulta.html'> Abandone la aplicación </a>";
        }
        // Cerrar la conexión a la base de datos
        $conn->close();
    } else {
        // No se proporcionó el nombre del gato
        echo "No has tecleado nada";
    }
}
?>
</body>
</html>
