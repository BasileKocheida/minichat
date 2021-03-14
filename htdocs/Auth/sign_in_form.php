<?php // Formulaire d'inscription
try {
    $pdo = new PDO('mysql:host=mini_chat.loc;dbname=minichat', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>
<?php
$userStatement = $pdo->prepare("SELECT * FROM user");
?>
<?php if (!empty($_GET["message"])) : ?>
        <div style="padding: 10px;background:gray;color:#fff;">
            <?=$_GET["message"]?>
        </div>
<?php endif;?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="../customa.css" rel="stylesheet">
    <title>Log in</title>
</head>
<body>
<nav>
    <div class="nav-wrapper #283593 indigo darken-3">
      <a href="#!" class="brand-logo"><i class="material-icons">child_care</i>MINICHAT</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="sign_in_form.php"><i class="material-icons">group_add</i></a></li>
        <li><a href="login_form.php"><i class="material-icons">settings_power</i></a></li>
        <li><a href="../minichat.php"><i class="material-icons">view_module</i></a></li>
      </ul>
    </div>
  </nav>

    <form action="./process/process_sign_in.php" method="post">
                    <h4>Sign in</h4>

                    <label><b>Pseudo</b></label>
                    <input type="text" placeholder="pseudo" required name="pseudo"><br>

                    <label><b>Password</b></label>
                    <input type="password" placeholder="password" required name="password"><br>

                    <button class="btn waves-effect #283593 indigo darken-3"> Sign in</button>
    <br>
    </form>

    <?php include __DIR__.'/../partials/footer.php' ?>
