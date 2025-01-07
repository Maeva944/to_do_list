<?php 

require_once '../bdd/Database.php';

Class UserModel{
    public function logIn($username, $password){
        global $pdo;
        $stmp = $pdo->prepare("SELECT * FROM `user` WHERE username = :username");
        $stmp->execute(['username' => $username]);
        $user = $stmp->fetch();

        if ($user && password_verify($password, $user['password'])){
            return $user;
        }
        echo "Mot de passe incorrecte";
    }

    public function register($username, $email, $password){
        global $pdo;
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmp = $pdo->prepare("INSERT INTO user (username, email, password) Value (:username, :email, :password)");
        $stmp->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);
    }
}

?>