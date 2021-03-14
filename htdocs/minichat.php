<?php
session_start();
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

    include __DIR__.'/partials/header.php';
?>

<div class='row'> 
    <h4>Start to <span>chat!</span></h4>
    <div class="box col s8">
        <div  id="box-chat" class="box-chat">
            <div  style="overflow-y: auto" class='content-msg'>
            <?php       
               include ('load-msg.php');
            ?>
            </div>
        </div>    
        <?php if(isset($_SESSION['pseudo'])){ ?>
      <div class='formulaire'><br><br>

                <label for="pseudo">Pseudo : </label> <!--condition ternaire-->
                <input type="text" id="pseudo" name="pseudo" value="<?=empty($_SESSION['pseudo']) ? "" : $_SESSION["pseudo"] ?>"><br><br>
                <label for="msg">Message : </label>  
                <textarea type="text" id="message" name="msg"></textarea><br><br>
                

                <button class="btn waves-effect #283593 indigo darken-3" onclick="sendMessage()"> Envoyer</button>

            <br>
       </div>
       <?php }else{ ?>
        <h2>Vous devez vous connectez pour envoyer un message !</h2>
       <?php } ?>
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

<?php include 'partials/footer.php' ?>
