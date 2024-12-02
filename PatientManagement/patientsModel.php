<?php
function getAllPatients($pdo) {
    $stmt = $pdo->query("SELECT * FROM Patients");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addPatient($pdo, $firstName, $lastName, $dob, $married) {
    $stmt = $pdo->prepare("INSERT INTO Patients (firstName, lastName, dob, married) VALUES (?, ?, ?, ?)");
    $stmt->execute([$firstName, $lastName, $dob, $married]);
}
?>
