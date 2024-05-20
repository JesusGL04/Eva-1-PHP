


<?php
    // Paso 1: Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "votaciones";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Paso 2: Consultar las preguntas de la base de datos
    $sql = "SELECT id_pregunta, descripcion, votos_si AS aFavor, votos_no AS enContra FROM preguntas";
    $result = $conn->query($sql);
    ?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ver votaciones</title>
    </head>
    <body>

    <h1>Ver resultados</h1>

    <a href="preguntas-formulario.php">Votar</a>
    <a href="preguntas.php">Ver votaciones</a><br><br>
  
    <?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "votaciones";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// IDs de las preguntas a mostrar
$id_preguntas = [1, 2, 3];

// Construir la consulta SQL
$sql = "SELECT id_pregunta, descripcion, votos_si, votos_no FROM preguntas WHERE id_pregunta IN (" . implode(",", $id_preguntas) . ")";

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar los resultados
    while($row = $result->fetch_assoc()) { 
        echo $row["descripcion"] . "<br>";
        echo $row["votos_si"] . "<br>";
        echo $row["votos_no"] . "<br>";
        echo "<br>";
    }
} else {
    echo "No se encontraron preguntas con esos IDs.";
}

// Cerrar conexión
$conn->close();
?>




    </body>
    </html>
