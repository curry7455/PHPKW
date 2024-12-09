<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit;
}
require_once 'model/Movies.php';

$moviesModel = new Movies();
$watchlist = $moviesModel->getWatchlistByUserId($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Watchlist</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1><?php echo htmlspecialchars($_SESSION['username']); ?>'s Watchlist</h1>
    <a href="dashboard.php">Back to Dashboard</a>
    <a href="logout.php">Logout</a>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($watchlist as $movie): ?>
            <tr>
                <td><?php echo htmlspecialchars($movie['title']); ?></td>
                <td><?php echo htmlspecialchars($movie['genre']); ?></td>
                <td>
                    <a href="remove_from_watchlist.php?id=<?php echo $movie['id']; ?>">Remove</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
