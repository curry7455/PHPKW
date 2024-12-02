<?php
include 'db.php';
include 'patientsModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $married = isset($_POST['married']) ? 1 : 0;

    addPatient($pdo, $firstName, $lastName, $dob, $married);
    header('Location: index.php'); // redirect to view patients
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Patient</title>
</head>
<body>
    <h1>Add Patient</h1>
    <form method="post">
        <label>First Name:</label>
        <input type="text" name="firstName" required><br>
        <label>Last Name:</label>
        <input type="text" name="lastName" required><br>
        <label>Date of Birth:</label>
        <input type="date" name="dob" required><br>
        <label>Married:</label>
        <input type="checkbox" name="married"><br>
        <button type="submit">Add Patient</button>
    </form>
    <a href="index.php">Cancel</a>
</body>
</html>
