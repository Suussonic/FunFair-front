<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum - Fun Fair</title>
    <link rel="stylesheet" href="/public/assets/css/forum.css">
</head>
<body>
    <header>
        <h1>Forum de Fun Fair</h1>
    </header>

    <main>
        <section class="discussion">
            <h2>Discussions</h2>
            <div class="message">
                <h3>Jean Dupont</h3>
                <p>J'ai adoré la grande roue! C'était incroyable de voir tout le parc depuis les hauteurs.</p>
                <span class="timestamp">Posté le 17 août 2024 à 14:35</span>
            </div>
            <div class="message">
                <h3>Marie Claire</h3>
                <p>Les montagnes russes sont vraiment géniales, mais un peu trop rapides pour moi.</p>
                <span class="timestamp">Posté le 16 août 2024 à 11:15</span>
            </div>
            <!--  si on veux on se basse comme le truc en haut c'est un exemple juste pour donner plus de truc au cite -->
        </section>

        <section class="new-message">
            <h2>Postez un nouveau message</h2>
            <form>
                <label for="username">Nom:</label>
                <input type="text" id="username" name="username" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Envoyer</button>
            </form>
        </section>
    </main>

    <footer>
        <a href="/">Retour à l'accueil</a>
    </footer>
</body>
</html>
