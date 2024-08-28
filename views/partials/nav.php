<header>
    <?php
    if (isset($_SESSION['firstname'])) {
        echo '<a class="Connexion" href="/logout">deconnexion</a>';
        echo '<a class="Connexion" href="/back">Back temporaire</a>';
        if ($_SESSION['role'] === 'admin') echo '<a class="Connexion" href="/back">back</a>';
    } else {
        echo '<a class="Connexion" href="/login">Se Connecter</a>';
        echo '<a class="Connexion" href="/back">autre back temporaire</a>';
    }
    ?>
</header>