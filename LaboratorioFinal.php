<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario PHP</title>
    <link href="LaboratorioFinal.css" rel="stylesheet" type="text/css">
    <script src="LaboratorioFinal.js"></script>
</head>
<body>
    <div class="grupo">
        <?php
        
        function mostrarFormulario()
        {
            echo '
            <form id="formulario" method="POST" action="">
                <h2><em>Formulario Registro</em></h2>
                <label for="nombre">Nombre <span><em>(requerido)</em></span></label>
                <input type="text" name="nombre" class="form-input" required /><br /><br />

                <label for="primer_apellido">Primer apellido <span><em>(requerido)</em></span></label>
                <input type="text" name="primer_apellido" class="form-input" required /><br /><br />

                <label for="segundo_apellido">Segundo Apellido <span><em>(requerido)</em></span></label>
                <input type="text" name="segundo_apellido" class="form-input" required /><br /><br />

                <label for="email">Email <span><em>(requerido)</em></span></label>
                <input type="email" name="email" class="form-input" required /><br /><br />

                <label for="login1">Login <span><em>(requerido)</em></span></label>
                <input type="text" name="login1" class="form-input" required /><br /><br />

                <label for="contraseña">Contraseña <span><em>(requerido)</em></span></label>
                <input type="password" name="contraseña" pattern=".{4,8}" class="form-input" required /><br /><br />

                <input class="form-btn" name="submit" type="submit" value="Suscribirse" />
            </form>
            ';
        }

        
        function mostrarRegistros()
        {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ejerciciofinal";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM formulario";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Nombre: " . $row["nombre"] . "<br>";
                    echo "Primer apellido: " . $row["primer_apellido"] . "<br>";
                    echo "Segundo apellido: " . $row["segundo_apellido"] . "<br>";
                    echo "Email: " . $row["email"] . "<br>";
                    echo "Login: " . $row["login1"] . "<br>";
                    echo "Contraseña: " . $row["contraseña"] . "<br>";
                    echo "<br>";
                }
            } else {
                echo "No se encontraron registros en la base de datos.";
            }

            $conn->close();
        }

       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $primer_apellido = $_POST['primer_apellido'];
            $segundo_apellido = $_POST['segundo_apellido'];
            $email = $_POST['email'];
            $login1 = $_POST['login1'];
            $contraseña = $_POST['contraseña'];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "ejerciciofinal";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $checkEmailQuery = "SELECT * FROM formulario WHERE email = '$email'";
            $checkEmailResult = $conn->query($checkEmailQuery);
            if ($checkEmailResult->num_rows > 0) {
                echo "El correo electrónico ya está registrado en la base de datos.";
                $conn->close();
                mostrarFormulario();
            } else {
                $sql = "INSERT INTO formulario (nombre, primer_apellido, segundo_apellido, email, login1, contraseña)
                        VALUES ('$nombre', '$primer_apellido', '$segundo_apellido', '$email', '$login1', '$contraseña')";

                if ($conn->query($sql) === TRUE) {
                    echo "Registro completado con éxito";
                    echo '<br><br><a href="consulta.php" class="form-btn">Consulta</a>';
                } else {
                    echo "Error:" . $sql . "<br>" . $conn->error;
                    mostrarFormulario();
                }

                $conn->close();
            }
        } else {
            mostrarFormulario();
        }
        ?>
    </div>
</body>
</html>
