<header>
    <?php
    if (isset($_SESSION['firstname'])) {
        echo '<a class="Connexion" href="/logout">deconnexion</a>';
        echo '<a class="Connexion" href="/back">back</a>';
    } else {
        echo '<a class="Connexion" href="/login">Se Connecter</a>';
        echo '<a class="Connexion" href="/back">back</a>';
    }
   ?>
</header>