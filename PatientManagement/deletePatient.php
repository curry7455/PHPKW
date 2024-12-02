<?php
// database connection
require 'db.php';

// patient ID from the POST request
$id = $_POST['id'] ?? null;

if ($id) {
    // DELETE query
    $stmt = $db->prepare("DELETE FROM Patients WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

// redirect to View Patients page
header('Location: index.php');
exit();
?>
