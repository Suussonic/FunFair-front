<header>
    <?php
    if (isset($_SESSION['firstname'])) {
    } else {
        echo '<a class="Connexion" href="/login">Se Connecter</a>';
    }
   ?>
</header>