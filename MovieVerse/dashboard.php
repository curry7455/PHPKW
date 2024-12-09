<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit;
}
require_once 'model/Movies.php';

$moviesModel = new Movies();
$movies = $moviesModel->getMovies();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <a href="logout.php">Logout</a>
    <h2>Movies List</h2>
    <a href="movie_form.php">Add New Movie</a>
    <form method="GET">
        <input type="text" name="search" placeholder="Search movies...">
        <button type="submit">Search</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Genre</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $movie): ?>
            <tr>
                <td><?php echo htmlspecialchars($movie['title']); ?></td>
                <td><?php echo htmlspecialchars($movie['genre']); ?></td>
                <td><?php echo htmlspecialchars($movie['rating']); ?></td>
                <td>
                    <a href="movie_form.php?id=<?php echo $movie['id']; ?>">Edit</a>
                    <a href="delete_movie.php?id=<?php echo $movie['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
