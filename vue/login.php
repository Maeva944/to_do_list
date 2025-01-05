<?php 
session_start();
require_once('header.php');

require_once('../bdd/Database.php');

$database = new Database;
$pdo = $database->pdo;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    }else {
        $stmp = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmp->execute(['username' => $username]);
        $user = $stmp->fetch();

        if ($user && password_verify($password, $user ['password'])){

        }
    }
}

?>

<body>
    <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Votre nom d'utilisateur" required>
        <input type="password" name="pswd" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
    <p>Vous n'avez pas encore de compte ? <a href="register.php">S'inscrire</a></p>
</body>

<?php 
require_once('footer.php');
?>