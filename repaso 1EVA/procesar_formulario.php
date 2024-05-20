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
    //die("Conexión fallida: " . $conn->connect_error);
}


// Verificar si se han marcado las casillas de voto a favor o en contra
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Si se ha pulsado Si.
    if (isset($_POST['aFavor'])) {
        $id_pregunta = $_POST['pregunta'];

        // Actualizar votos a favor
        $sqlSi = "UPDATE preguntas SET votos_si = votos_si + 1 WHERE id_pregunta = '$id_pregunta'";

        //Si se realiza la sentencia
        if ($conn->query($sqlSi) === TRUE) {
          //Se actualiza
        }
    }


    //Si se ha pulsado No.
    elseif (isset($_POST['enContra'])) {
        $id_pregunta = $_POST['pregunta'];

        // Actualizar votos en contra
        $sqlNo = "UPDATE preguntas SET votos_no = votos_no + 1 WHERE id_pregunta = '$id_pregunta'";

        //Si se realiza la sentencia
        if ($conn->query($sqlNo) === TRUE) {
            //Se actualiza
        }
    }

}

// Cerrar la conexión a la base de datos
$conn->close();

//Mensaje personalizado para el manejador que pinta el estado de la votacion

$mensaje = "Votacion realizada";

$arrMensaje= [
    "mensaje"=> $mensaje
];

echo json_encode($arrMensaje);
?>