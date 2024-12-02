<?php
require 'db.php';

$stmt = $db->prepare("SELECT id, first_name, last_name, married, birth_date FROM Patients");
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patients</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Patients List</h1>
    <a href="patientDetails.php">Add Patient</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Married</th>
                <th>Birth Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient): ?>
                <tr>
                    <td><?= htmlspecialchars($patient['first_name']) . ' ' . htmlspecialchars($patient['last_name']); ?></td>
                    <td><?= $patient['married'] ? 'Yes' : 'No'; ?></td>
                    <td><?= htmlspecialchars($patient['birth_date']); ?></td>
                    <td>
                        <a href="patientDetails.php?id=<?= $patient['id']; ?>">Edit</a>
                        <form method="POST" action="deletePatient.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $patient['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
