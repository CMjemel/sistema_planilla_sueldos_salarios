<?php
require 'conexion.php';

$stmt = $pdo->query("SELECT * FROM bonos_descuentos");
$bd = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($bd);
?>
