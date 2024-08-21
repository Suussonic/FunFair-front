<?php
global $dbh;
session_start();
include_once('db.php');
include('logs.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $editUserSql = '
        UPDATE users
        SET firstname = :firstname,
            lastname = :lastname,
            email = :email,
            gender = :gender,
            `theme` = :theme
        WHERE id = :id
    ';

    $preparedEditUser = $dbh->prepare($editUserSql);
    $preparedEditUser->execute([
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'gender' => $_POST['gender'],
        'theme' => $_POST['theme'],
        'id' => $_SESSION['userId']
    ]);
    $_SESSION['firstname'] = $_POST['firstname'];
    $_SESSION['lastname'] = $_POST['lastname'];
    insert_logs('modification de donnée');
}


$getUser = "SELECT id, firstname, lastname, email, gender, theme FROM users WHERE id = :id";

$preparedGetUser = $dbh->prepare($getUser);
$preparedGetUser->execute([
    'id' => $_SESSION['userId']
]);

$user = $preparedGetUser->fetch();
$test = "SELECT id_carte FROM classeur WHERE firstname=:firstname"

?>
<script type="text/javascript">
    let test = "<?php echo $test; ?>";
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/account.css">
    <link rel="shortcut icon" href="../ASSET/CARDBINDEX V5.png" type="image/x-icon">
    <?php include './theme.php'; ?>
    <title>Mon compte</title>
</head>

<body>

    <h1>Bienvenue <?php echo $_SESSION['firstname'] ?></h1>

    <form action="" method="POST">
        <div class="mb-3">
            <div>
                <label for="firstname">Pseudo</label>
                <input id="firstname" type="text" name="firstname" placeholder="Prenom" value="<?php echo $user['firstname'] ?>">
            </div>
        </div>
        <div class="mb-3">
            <!--  NOM  -->
            <div>
                <label for="lastname">Nom</label>
                <input id="lastname" type="text" name="lastname" value="<?php echo $user['lastname'] ?>">
            </div>
        </div>
        <div class="mb-3">
            <!--  EMAIL  -->
            <div>
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?php echo $user['email'] ?>">
            </div>
        </div>
        <div class="radio-container">
            <label for="man">Homme</label>
            <input id="man" type="radio" name="gender" value="man" <?php echo $user['gender'] === "man" ? 'checked' : '' ?>>

            <label for="woman">Femme</label>
            <input id="woman" type="radio" name="gender" value="woman" <?php echo $user['gender'] === "woman" ? 'checked' : '' ?>>

            <label for="other">Autre</label>
            <input id="other" type="radio" name="gender" value="other" <?php echo $user['gender'] === "other" ? 'checked' : '' ?>>
        </div>
        <div class="radio-container">
            <label for="noir">Noir</label>
            <input id="noir" type="radio" name="theme" value="1" <?php echo $user['theme'] == '1' ? 'checked' : ''; ?>>
            <label for="blanc">Blanc</label>
            <input id="blanc" type="radio" name="theme" value="0" <?php echo $user['theme'] == '0' ? 'checked' : ''; ?>>
        </div>



        <input type="submit" value="Modifier">
        <a id="deco" href="../PHP/logout.php">Se deconnecter</a>
    </form>
</body>

</html>