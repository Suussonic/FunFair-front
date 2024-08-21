<?php
// Inclure le fichier de connexion à la base de données et les fonctions de logging
require_once('db.php');
include('logs.php');

$errorInfo = false;

// Vérifier si la connexion à la base de données est réussie
if (!$dbh) {
    die('Connexion à la base de données échouée.');
}

// Vérifier si le formulaire a été soumis
if (isset($_POST['email']) && isset($_POST['password'])) {
    // Sanitize les données de l'utilisateur
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Préparer la requête pour récupérer l'utilisateur par email
    $loginSql = 'SELECT * FROM users WHERE email = :email';

    $preparedLoginRequest = $dbh->prepare($loginSql);

    if (!$preparedLoginRequest) {
        die('Erreur lors de la préparation de la requête SQL : ' . implode(", ", $dbh->errorInfo()));
    }

    $preparedLoginRequest->execute(['email' => $email]);
    // Exécuter la requête
    if (!$preparedLoginRequest->execute(['email' => $email])) {
        die('Erreur lors de l\'exécution de la requête SQL : ' . implode(", ", $preparedLoginRequest->errorInfo()));
    }

    // Récupérer l'utilisateur depuis la base de données
    $user = $preparedLoginRequest->fetch(PDO::FETCH_ASSOC);
    var_dump($user); // Affiche les informations utilisateur pour debugging

    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($user) {
        if (password_verify($password, $user['password'])) {
            session_start();
            // Stocker les informations utilisateur dans la session
            $_SESSION['userId'] = $user['id'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['user'] = $user;
            $_SESSION['theme'] = $user['theme'] ?? 'default'; // Si le champ theme existe

            insert_logs('connexion');
            header('location:../index.php');
            header('location:../index.php'); // Rediriger vers la page d'accueil
            exit;
        } else {
            $errorInfo = true;

        $errorInfo = true;
    }
}

?>

<!DOCTYPE html>

            <input id="password" placeholder="Mot de passe" type="password" name="password" required>
        </div>
        <?php
        // Afficher un message d'erreur si les informations sont incorrectes
        if ($errorInfo) {
            echo "<p class='error'>Utilisateur ou Mot de passe incorrect</p>";
        }
        ?>
        <input type="submit" class="btn" value="Se connecter">
        <a href="form.php">
            <div id="btn2">S'inscrire</div>
        </a>
    </form>
    <p>Mot de passe oublié ? <u style="color:#f1c40f;">Cliquez ici !</u></p>
</body>
</html>