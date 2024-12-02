<?php
include 'db.php';
include 'patientsModel.php';

$patients = getAllPatients($pdo);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Patients</title>
</head>
<body>
    <h1>Patients List</h1>
    <a href="addPatient.php">Add Patient</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>DOB</th>
            <th>Married</th>
        </tr>
        <?php foreach ($patients as $patient): ?>
            <tr>
                <td><?= $patient['id'] ?></td>
                <td><?= htmlspecialchars($patient['firstName']) ?></td>
                <td><?= htmlspecialchars($patient['lastName']) ?></td>
                <td><?= htmlspecialchars($patient['dob']) ?></td>
                <td><?= $patient['married'] ? 'Yes' : 'No' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
