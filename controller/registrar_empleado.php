<?php
require 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

$ci = $data['ci'];
$nombre = $data['nombre'];
$sueldo = $data['sueldo'];

try {
  $sql = "INSERT INTO empleados (ci, nombre, sueldo) VALUES (?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$ci, $nombre, $sueldo]);
  echo json_encode(["success" => true]);
} catch (PDOException $e) {
  echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
