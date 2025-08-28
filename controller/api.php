<?php
$conexion = new mysqli("localhost", "root", "", "planillasoft");

if ($conexion->connect_error) {
  die("Conexión fallida: " . $conexion->connect_error);
}

header("Content-Type: application/json");

switch ($_GET["accion"]) {
  case "listarEmpleados":
    $res = $conexion->query("SELECT * FROM empleados");
    echo json_encode($res->fetch_all(MYSQLI_ASSOC));
    break;

  case "registrarEmpleado":
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $conexion->prepare("INSERT INTO empleados (nombre, ci, cargo, area, sueldo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $data["nombre"], $data["ci"], $data["cargo"], $data["area"], $data["sueldo"]);
    $stmt->execute();
    echo json_encode(["status" => "ok"]);
    break;

  case "agregarBD":
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $conexion->prepare("INSERT INTO bonos_descuentos (tipo, ci_empleado, monto) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $data["tipo"], $data["ciEmpleado"], $data["monto"]);
    $stmt->execute();
    echo json_encode(["status" => "ok"]);
    break;

  case "listarBD":
    $res = $conexion->query("SELECT * FROM bonos_descuentos");
    echo json_encode($res->fetch_all(MYSQLI_ASSOC));
    break;
}
?>
