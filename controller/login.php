<?php
session_start();

$host = "localhost";
$db = "planilla_db1";
$user = "jemel";
$pass = "dxn8725769";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $ci = $_POST['ci'];
    $password = $_POST['password'];

    // Consulta preparada para evitar inyección SQL
    $stmt = $conn->prepare("SELECT password FROM usuarios WHERE usuario = ? AND ci = ?");
    $stmt->bind_param("ss", $usuario, $ci);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['usuario'] = $usuario;
            header("Location: principal.html"); // o principal.php si quieres cargar datos dinámicos
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario o carnet no existe.";
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Login - Error</title>
</head>
<body>
  <?php if (isset($error)): ?>
    <p style="color:red;"><?= $error ?></p>
  <?php endif; ?>
  <a href="index.html">Volver al login</a>
</body>
</html>
