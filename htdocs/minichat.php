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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="customa.css" rel="stylesheet">
    <title>MINICHAT</title>
</head>

<body>
<nav>
    <div class="nav-wrapper #283593 indigo darken-3">
      <a href="#!" class="brand-logo"><i class="material-icons">child_care</i>MINICHAT</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="login.php"><i class="material-icons">group_add</i></a></li>
        <li><a href="minichat.php"><i class="material-icons">view_module</i></a></li>
        <li><a href="collapsible.html"><i class="material-icons">refresh</i></a></li>
        <li><a href="mobile.html"><i class="material-icons">more_vert</i></a></li>
      </ul>
    </div>
  </nav>

<div class='row'> 
    <h4>Start to <span>chat!</span></h4>
    <div class="box col s8">
        <div class="box-chat">
            <div class='content-msg'>
            <?php       
               include ('load-msg.php');
            ?>
            </div>
        </div>    
      <div class='formulaire'><br><br>

                <label for="pseudo">Pseudo : </label> <!--condition ternaire-->
                <input type="text" id="pseudo" name="pseudo" value="<?=empty($_COOKIE['pseudo']) ? "" : $_COOKIE["pseudo"] ?>"><br><br>
                <label for="msg">Message : </label>  
                <textarea type="text" id="message" name="msg"></textarea><br><br>
                <!--<input id="color" type="hidden" name="color" value="?>"><br>-->

                <button class="btn waves-effect #283593 indigo darken-3" onclick="sendMessage()"> Envoyer</button>

            <br>
       </div>
    </div>  
       
        <div class="userlist col s4">
            <h4>USER LIST</h4>
                <p>
                <?php    
                $userList = $pdo->prepare('SELECT pseudo, color FROM user');
                $userList->execute();
                $getUserList = $userList ->fetchAll(PDO::FETCH_ASSOC);

                foreach ($getUserList as $users) { ?>
                   
                <img src="https://img.icons8.com/emoji/20/000000/green-circle-emoji.png"/>
                <span style="color : <?=$users['color']?>;">
                
                <?= $users['pseudo']?></span><br>
               <?php } ?> 
                
                </p>
    </div>
          
</div> 

<footer>

    <p class="foot"> Follow Us !</p>
    <img src="https://img.icons8.com/color/48/000000/instagram-new--v2.png">
    <img src="https://img.icons8.com/color/48/000000/snapchat-circled-logo--v5.png">
    <img src="https://img.icons8.com/nolan/48/facebook-f.png">

</footer>


<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript" src="main.js"></script>
</body>
</html>