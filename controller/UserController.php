<?php 
include_once('../model/UserModel.php');

class UserController {
    private $model;

    public function __construct($pdo) {
        $this->model = new UserModel($pdo);
    }

    // Méthode de connexion
    public function login() {
        session_start();

        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des champs du formulaire
            $username = trim(htmlspecialchars($_POST['username']));
            $password = trim(htmlspecialchars($_POST['password']));

            // Vérification des champs vides
            if (empty($username) || empty($password)) {
                $error = "Veuillez remplir tous les champs.";
            } else {
                // Vérifie les identifiants via le modèle
                $user = $this->model->logIn($username, $password);

                if ($user) {
                    // Création de la session utilisateur
                    $_SESSION['username'] = $user['username'];
                    header("Location: dashboard.php");
                    exit();
                } else {
                    $error = "Nom d'utilisateur ou mot de passe incorrect.";
                }
            }
        }

        // Charge la vue de connexion
        include('../vue/login.php');
    }

    // Méthode d'inscription
    public function register() {
        session_start();

        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des champs du formulaire
            $username = trim(htmlspecialchars($_POST['nom']));
            $email = trim(htmlspecialchars($_POST['email']));
            $password = trim(htmlspecialchars($_POST['password']));

            // Vérification des champs vides
            if (empty($username) || empty($email) || empty($password)) {
                $error = "Veuillez remplir tous les champs.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Veuillez entrer un email valide.";
            } else {
                // Hashage du mot de passe
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                try {
                    // Appelle le modèle pour enregistrer l'utilisateur
                    $this->model->registerUser($username, $email, $hashed_password);
                    $success = "Inscription réussie ! Vous pouvez vous connecter dès maintenant.";
                } catch (Exception $e) {
                    $error = "Une erreur est survenue : " . $e->getMessage();
                }
            }
        }

        // Charge la vue d'inscription
        include('../vue/register.php');
    }
}
