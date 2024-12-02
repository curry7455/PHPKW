<?php
session_start();
require 'db.php';

// login page if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// search for patient by info
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchTerm = "%" . $_GET['search'] . "%";
    $searchQuery = " WHERE first_name LIKE :search OR last_name LIKE :search OR marital_status LIKE :search";
}

$stmt = $db->prepare("SELECT * FROM patients" . $searchQuery);
if ($searchQuery) {
    $stmt->bindParam(':search', $searchTerm);
}
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Patients - Patient EHR</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Patient List</h2>
    <form method="GET">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search">
        <button type="submit">Search</button>
    </form>

    <a href="logoff.php">Log off</a>

    <h3>Patient Records:</h3>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Marital Status</th>
        </tr>
        <?php foreach ($patients as $patient): ?>
            <tr>
                <td><?= htmlspecialchars($patient['first_name']); ?></td>
                <td><?= htmlspecialchars($patient['last_name']); ?></td>
                <td><?= htmlspecialchars($patient['marital_status']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
