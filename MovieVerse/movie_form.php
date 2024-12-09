<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit;
}
require_once 'model/Movies.php';

$moviesModel = new Movies();
$isEditing = isset($_GET['id']);
$movie = $isEditing ? $moviesModel->getMovieById($_GET['id']) : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'title' => $_POST['title'],
        'genre' => $_POST['genre'],
        'rating' => $_POST['rating'],
        'cast' => $_POST['cast'],
        'release_date' => $_POST['release_date'],
        'synopsis' => $_POST['synopsis']
    ];

    if ($isEditing) {
        $moviesModel->updateMovie($_GET['id'], $data);
    } else {
        $moviesModel->addMovie($data);
    }
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $isEditing ? "Edit" : "Add"; ?> Movie</title>
</head>
<body>
    <h1><?php echo $isEditing ? "Edit" : "Add"; ?> Movie</h1>
    <form method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo $movie['title'] ?? ''; ?>" required>
        <label for="genre">Genre:</label>
        <input type="text" name="genre" value="<?php echo $movie['genre'] ?? ''; ?>" required>
        <label for="rating">MovieVerse Rating:</label>
        <input type="number" name="rating" step="0.1" value="<?php echo $movie['rating'] ?? ''; ?>" required>
        <label for="cast">Cast:</label>
        <textarea name="cast"><?php echo $movie['cast'] ?? ''; ?></textarea>
        <label for="release_date">Release Date:</label>
        <input type="date" name="release_date" value="<?php echo $movie['release_date'] ?? ''; ?>" required>
        <label for="synopsis">Synopsis:</label>
        <textarea name="synopsis"><?php echo $movie['synopsis'] ?? ''; ?></textarea>
        <button type="submit"><?php echo $isEditing ? "Update" : "Add"; ?> Movie</button>
    </form>
</body>
</html>
