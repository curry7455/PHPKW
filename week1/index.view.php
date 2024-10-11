<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        header {
            background: #e3e3e3;
            padding: 2em;
            text-align: center;
        }
        </style>
</head>
<body>
    <header>
        <h1>
         Hello, Animals!   
        </h1>
    </header>
    <p>
        <ul>
            <?php
            foreach ($animals as $animal) {
                echo "<li>$animal</li>";
            }
            ?>
        </ul>

        <ul>
                <li>
                    <strong>Name: </strong> <?= $task['title']; ?>
                </li>
                <li>
                    <strong>Due Date: </strong> <?= $task['due']; ?>
                </li>
                <li>
                    <strong>Assigned: </strong> <?= $task['assigned_to']; ?>
                </li>
                <li>
                    <strong>Status: </strong> <?= $task['completed'] ? 'Complete' : 'Incomplete'; ?>
                </li> 
        </ul>


</body>
</html>