<?php
require 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

$tipo = $data['tipo'];
$ci_empleado = $data['ciEmpleado'];
$monto = $data['monto'];

try {
  $sql = "INSERT INTO bonos_descuentos (tipo, ci_empleado, monto) VALUES (?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$tipo, $ci_empleado, $monto]);
  echo json_encode(["success" => true]);
} catch (PDOException $e) {
  echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
