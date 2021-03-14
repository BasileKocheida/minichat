<?php // Formulaire de connexion 

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


<?php include __DIR__.'/../partials/header.php'; ?>


    <form action="./process/process_login.php" method="post">
                    <h4> Please login to use the chat!</h4>

                    <label><b>Pseudo</b></label>
                    <input type="text" placeholder="pseudo" required name="pseudo"><br>

                    <label><b>Password</b></label>
                    <input type="password" placeholder="password" required name="password"><br>

                    <button class="btn waves-effect #283593 indigo darken-3"> log in</button>
    <br>
    </form>



    <?php include __DIR__.'/../partials/footer.php' ?>


