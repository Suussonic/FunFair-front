<?php
global $dbh;
session_start();
include_once('db.php');
include('../BACK/logs.php');

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
