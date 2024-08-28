<header>
    <?php
    require_once('/models/Database.php');
    session_start();
    if (isset($_SESSION['firstname'])) {
        echo '<a class="Connexion" href="/logout">deconnexion</a>';
        if ($_SESSION['role'] === 'admin') echo '<a class="Connexion" href="/back">back</a>';
    } else {
        echo '<a class="Connexion" href="/login">Se Connecter</a>';
    }
    ?>
</header>