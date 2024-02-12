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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreGato = $_POST["gato"];
    $nombreDueño = $_POST["persona"];
    $telefonoDueño = $_POST["telefono"];

    if (empty($nombreGato) || empty($nombreDueño) || empty($telefonoDueño)) {
        echo "Por favor, complete todos los campos.";
    } else {
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
        }

        $sqlVerificarDueño = "SELECT id FROM personas WHERE nombre = '$nombreDueño'";
        $resultVerificarDueño = $conn->query($sqlVerificarDueño);

        if ($resultVerificarDueño->num_rows > 0) {
            $rowDueño = $resultVerificarDueño->fetch_assoc();
            $idPersona = $rowDueño["id"];
        } else {
            $sqlInsertarDueño = "INSERT INTO personas (nombre, telefono) VALUES ('$nombreDueño', '$telefonoDueño')";
            if ($conn->query($sqlInsertarDueño) === TRUE) {
                $idPersona = $conn->insert_id;
            } else {
                echo "Error al registrar el dueño: " . $conn->error;
                echo "<br> <a href='./registro.html'><button>Volver al registro</button></a>";
                $conn->close();
                exit();
            }
        }

        $sqlVerificarGato = "SELECT id FROM gatos WHERE gato = '$nombreGato'";
        $resultVerificarGato = $conn->query($sqlVerificarGato);

        if ($resultVerificarGato->num_rows > 0) {
            echo "Ya existe un animalito con ese nombre. Por favor, elige otro nombre para el gato.";
            echo "<br> <a href='./registro.html'><button>Volver al registro</button></a>";
        } else {
            $sqlInsertarGato = "INSERT INTO gatos (gato, id_persona) VALUES ('$nombreGato', $idPersona)";
            if ($conn->query($sqlInsertarGato) === TRUE) {
                echo "Animalito registrado exitosamente.";
                echo "<br> <a href='./indexconsulta.html'><button>Volver al inicio</button></a>";
            } else {
                echo "Error al registrar el animalito: " . $conn->error;
                echo "<br> <a href='./indexconsulta.html'><button>Volver al inicio</button></a>";
            }
        }
        $conn->close();
    }
}
?>
</body>
</html>