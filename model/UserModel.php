<?php

class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour la connexion
    public function logIn($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM Utilisateurs WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        // Vérification du mot de passe
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    // Méthode pour l'inscription
    public function registerUser($username, $email, $hashed_password) {
        $stmt = $this->pdo->prepare("INSERT INTO Utilisateurs (nom, email, password) VALUES (:username, :email, :password)");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password
        ]);
    }
}
