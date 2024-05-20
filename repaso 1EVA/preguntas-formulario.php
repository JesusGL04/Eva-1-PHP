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
        <title>Formulario de Preguntas</title>
    </head>
    <body>

    <h1>Realizar votacion</h1>

    <a href="preguntas-formulario.php">Votar</a>
    <a href="preguntas.php">Ver votaciones</a><br><br>

    <form id="formulario">
        <label for="pregunta">Selecciona una pregunta:</label>

        <select name="pregunta" id="pregunta">

            <?php
            // Iterar sobre las preguntas y agregarlas al elemento desplegable
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id_pregunta"] . "'>" . $row["descripcion"] . "</option>";
                }
            } else {
                echo "No se encontraron preguntas en la base de datos.";
            }
            ?>

        </select>
        
        <br>
        <br>
        <input value="votoSi" name="aFavor" type="checkbox">Si</input>
        <br>
        <input value="votoNo" name="enContra" type="checkbox">No</input>

        <br><br>
        <input type="button" value="Enviar" onclick="votar()">

    <p id="votacion">(Realiza la votacion)</p>

    </form>

    <!-- JAVASCRIPT --------------------------------------------------------------------- -->    

    <script type="text/javascript">

    // 01 Función para manejar el estado de la votacion
    function manejarVoto(jsonData){

    //obtenemos elemento por id (en este caso "votacion")
    var votacion = document.getElementById("votacion");

    // actualizamos los elementos del DOM:
    // actualizamos el estado de la votacion
        votacion.innerHTML = jsonData.mensaje;
    }

    //////////////////////////////////////////////////////////


    // 02 Función para manejar la respuesta de la solicitud
    function votar() {

        //obtenemos elemento por id (en este caso "formulario")
        var formData = new FormData(document.getElementById("formulario"));

        //apunta al fichero que se va a dedicar a actualizar la base de datos.
        fetch("procesar_formulario.php", {
            method: "POST",
            body: formData
        })

        //si no hay respuesta con el servidor, se escribe el siguiente mensaje
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en el servidor');
            }
            // se devuelve el error
            return response.json();
        })

        //Si hay respuesta se pone en marcha tambien la siguiente funcion(en este caso se pondra en marcha la funcion "manejarVoto")
        .then(jsonData => {
            manejarVoto(jsonData);
        })

        //Si hay un error se muestra el siguiente mensaje
        .catch(error => {
            console.error('Hubo un error:', error);
        });
    }

    ////////////////////////////////////////////////////////////////////////

    </script>
    </body>
    </html>
