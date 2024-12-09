<?php
class Users {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=movieverse', 'root', '');
    }

    public function authenticate($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function registerUser($username, $password, $email) {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        $stmt->execute([
            'username' => $username,
            'password' => $password,
            'email' => $email
        ]);
    }
}
?>
