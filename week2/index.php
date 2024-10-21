<?php
// Initialize variables
$firstName = '';
$lastName = '';
$married = '';
$birthDate = '';
$heightFeet = '';
$heightInches = '';
$weight = '';
$age = '';
$bmi = '';
$bmiClassification = '';

// Function to calculate age
function age($birthDate) {
    $date = new DateTime($birthDate);
    $now = new DateTime();
    $interval = $now->dif ($date);
    return $interval->y;
}

// Function to calculate BMI
function bmi($feet, $inches, $weight) {
    // Convert height to meters and weight to kg
    $heightInInches = ($feet * 12) + $inches;
    $heightInMeters = $heightInInches * 0.0254;
    $weightInKg = $weight / 2.20462;
    return $weightInKg / ($heightInMeters * $heightInMeters);
}

// Function to classify BMI
function bmiDescription($bmi) {
    if ($bmi < 18.5) {
        return 'Underweight';
    } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
        return 'Normal weight';
    } elseif ($bmi >= 25.0 && $bmi <= 29.9) {
        return 'Overweight';
    } else {
        return 'Obese';
    }
}

// Handle form submission
if (isset($_POST['submit'])) {
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $married = $_POST['married'];
    $birthDate = $_POST['birth_date'];
    $heightFeet = filter_input(INPUT_POST, 'height_feet', FILTER_VALIDATE_FLOAT);
    $heightInches = filter_input(INPUT_POST, 'height_inches', FILTER_VALIDATE_FLOAT);
    $weight = filter_input(INPUT_POST, 'weight', FILTER_VALIDATE_FLOAT);

    // Validate inputs
    $errors = [];
    if (empty($firstName)) {
        $errors[] = 'First name cannot be empty.';
    }
    if (empty($lastName)) {
        $errors[] = 'Last name cannot be empty.';
    }
    if ($married !== 'yes' && $married !== 'no') {
        $errors[] = 'Please select your marital status.';
    }
    if (!strtotime($birthDate)) {
        $errors[] = 'Please enter a valid birth date.';
    }
    if ($heightFeet === false || $heightFeet < 0 || $heightInches === false || $heightInches < 0) {
        $errors[] = 'Please enter a valid height.';
    }
    if ($weight === false || $weight <= 0 || $weight > 1000) {
        $errors[] = 'Please enter a valid weight.';
    }

    // If no errors, calculate age, BMI, and classification
    if (empty($errors)) {
        $age = age($birthDate);
        $bmi = bmi($heightFeet, $heightInches, $weight);
        $bmiClassification = bmiDescription($bmi);
    }
}
?>

<h1>Patient Intake Form</h1>

<form method="post">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($firstName); ?>"><br>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($lastName); ?>"><br>

    <label for="married">Married:</label>
    <input type="radio" id="married_yes" name="married" value="yes" <?= ($married === 'yes') ? 'checked' : ''; ?>> Yes
    <input type="radio" id="married_no" name="married" value="no" <?= ($married === 'no') ? 'checked' : ''; ?>> No<br>

    <label for="birth_date">Birth Date:</label>
    <input type="date" id="birth_date" name="birth_date" value="<?= htmlspecialchars($birthDate); ?>"><br>

    <label for="height_feet">Height (Feet):</label>
    <input type="text" id="height_feet" name="height_feet" value="<?= htmlspecialchars($heightFeet); ?>"><br>

    <label for="height_inches">Height (Inches):</label>
    <input type="text" id="height_inches" name="height_inches" value="<?= htmlspecialchars($heightInches); ?>"><br>

    <label for="weight">Weight (Pounds):</label>
    <input type="text" id="weight" name="weight" value="<?= htmlspecialchars($weight); ?>"><br>

    <input type="submit" name="submit" value="Submit">
</form>

<?php if (isset($_POST['submit'])): ?>
    <?php if (!empty($errors)): ?>
        <h2>Errors</h2>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <h2>Confirmation</h2>
        <p>First Name: <?= htmlspecialchars($firstName); ?></p>
        <p>Last Name: <?= htmlspecialchars($lastName); ?></p>
        <p>Married: <?= htmlspecialchars($married); ?></p>
        <p>Birth Date: <?= htmlspecialchars($birthDate); ?></p>
        <p>Age: <?= htmlspecialchars($age); ?></p>
        <p>Height: <?= htmlspecialchars($heightFeet . ' ft ' . $heightInches . ' in'); ?></p>
        <p>Weight: <?= htmlspecialchars($weight . ' lbs'); ?></p>
        <p>BMI: <?= htmlspecialchars(number_format($bmi, 1)); ?></p>
        <p>BMI Classification: <?= htmlspecialchars($bmiClassification); ?></p>
    <?php endif; ?>
<?php endif; ?>

