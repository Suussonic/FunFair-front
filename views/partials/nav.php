<header>
    <?php
    if (isset($_SESSION['firstname'])) {
        echo '<a class="Connexion" href="/">Compte</a>';
    } else {
        echo '<a class="Connexion" href="/login">Se Connecter</a>';
    }
   ?>
</header>