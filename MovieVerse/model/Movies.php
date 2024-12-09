<?php
class Movies {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=movieverse', 'root', '');
    }

    public function getMovies() {
        $stmt = $this->db->query("SELECT * FROM movies");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMovieById($id) {
        $stmt = $this->db->prepare("SELECT * FROM movies WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addMovie($data) {
        $stmt = $this->db->prepare("INSERT INTO movies (title, genre, rating, cast, release_date, synopsis, user_id) VALUES (:title, :genre, :rating, :cast, :release_date, :synopsis, :user_id)");
        $stmt->execute(array_merge($data, ['user_id' => $_SESSION['user_id']]));
    }

    public function updateMovie($id, $data) {
        $stmt = $this->db->prepare("UPDATE movies SET title = :title, genre = :genre, rating = :rating, cast = :cast, release_date = :release_date, synopsis = :synopsis WHERE id = :id");
        $stmt->execute(array_merge($data, ['id' => $id]));
    }

    public function deleteMovie($id) {
        $stmt = $this->db->prepare("DELETE FROM movies WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function getWatchlistByUserId($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM movies WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
