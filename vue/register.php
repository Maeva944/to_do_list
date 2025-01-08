<?php 
require_once('../bdd/Database.php');
require_once('../controller/UserController.php');
require_once('header.php');
?>
<body>
    <h1>Inscription</h1>

    <!-- Affichage des messages d'erreur ou de succès -->
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form action="register.php" method="POST">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
        <input type="text" name="email" placeholder="email" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit">S'inscrire</button>
    </form>

    <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>
</body>
