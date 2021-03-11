<?php

try {
    $pdo = new PDO('mysql:host=mini_chat.loc;dbname=minichat', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}


if (isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['msg']) && !empty($_POST['msg'])) {
    die('paramètre manquant');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <link href="/custom.css" rel="stylesheet">
    <title>MINICHAT</title>
</head>

<body>
    <h1>MINI<span>CHAT</span></h1>
<div class='container'>
    <div class="box">
        
            <div class='content-msg'>
            <?php       
               include ('load-msg.php');
            ?>
            </div>    
      <div class='formulaire'><br><br>

                <label for="pseudo">Pseudo : </label> <!--condition ternaire-->
                <input type="text" id="pseudo" name="pseudo" value="<?=empty($_COOKIE['pseudo']) ? "" : $_COOKIE["pseudo"] ?>"><br><br>
                <label for="msg">Message : </label>  
                <textarea type="text" id="message" name="msg"></textarea><br><br>
                <!--<input id="color" type="hidden" name="color" value="?>"><br>-->

                <button onclick="sendMessage()"> Envoyer</button>

            <br>
       </div>
    </div>  
       
            <div class="userlist">
            <h1>USER LIST</h1>
                <?php    
                $userList = $pdo->prepare('SELECT pseudo FROM user');
                $userList->execute();
                $getUserList = $userList ->fetchAll(PDO::FETCH_ASSOC);

                foreach ($getUserList as $users) {
                    echo $users['pseudo'].'<br>';
                }
                
                ?> 
            </div>
          
</div> 

 
<script type="text/javascript" src="main.js"></script>
</body>
</html>