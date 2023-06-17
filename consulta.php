<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ejerciciofinal";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$stmt = $conn->query("SELECT * FROM formulario");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Lista de Usuarios Registrados</h2>";
echo "<ul>";
foreach ($usuarios as $usuario) {
    echo "<li>{$usuario['nombre']} {$usuario['primer_apellido']} {$usuario['segundo_apellido']}</li>";
}
echo "</ul>";
?>
