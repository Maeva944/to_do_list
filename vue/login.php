<?php 
session_start();
require_once('header.php');

require_once('../bdd/Database.php');

$database = new Database;
$pdo = $database->pdo;

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