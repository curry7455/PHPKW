<?php
require 'db.php';

$id = $_GET['id'] ?? null;
$patient = null;

if ($id) {
    $stmt = $db->prepare("SELECT * FROM Patients WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $married = isset($_POST['married']) ? 1 : 0;
    $birthDate = $_POST['birth_date'];

    if ($id) {
        $stmt = $db->prepare("UPDATE Patients SET first_name = :first_name, last_name = :last_name, married = :married, birth_date = :birth_date WHERE id = :id");
        $stmt->execute(['first_name' => $firstName, 'last_name' => $lastName, 'married' => $married, 'birth_date' => $birthDate, 'id' => $id]);
    } else {
        $stmt = $db->prepare("INSERT INTO Patients (first_name, last_name, married, birth_date) VALUES (:first_name, :last_name, :married, :birth_date)");
        $stmt->execute(['first_name' => $firstName, 'last_name' => $lastName, 'married' => $married, 'birth_date' => $birthDate]);
    }

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1><?= $id ? 'Edit Patient' : 'Add Patient'; ?></h1>
    <form method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($patient['first_name'] ?? ''); ?>" required>
        
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($patient['last_name'] ?? ''); ?>" required>
        
        <label for="married">Married:</label>
        <input type="checkbox" id="married" name="married" <?= isset($patient['married']) && $patient['married'] ? 'checked' : ''; ?>>
        
        <label for="birth_date">Birth Date:</label>
        <input type="date" id="birth_date" name="birth_date" value="<?= htmlspecialchars($patient['birth_date'] ?? ''); ?>" required>
        
        <button type="submit"><?= $id ? 'Update' : 'Add'; ?> Patient</button>
    </form>
    <a href="index.php">Cancel</a>
</body>
</html>
