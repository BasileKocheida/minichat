<?php

try {
    $pdo = new PDO('mysql:host=mini_chat.loc;dbname=minichat', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}


$r1 = $pdo->query('SELECT * FROM user 
JOIN message_user WHERE user.id = message_user.idUser ORDER BY dateHour DESC LIMIT 5');       

while ($donnees = $r1->fetch())
{ ?>
    <p>
        <strong style="color : <?=$donnees['color']?>;">
            <?=htmlspecialchars($donnees['pseudo'])?> <?=$donnees['dateHour']?>
        </strong> :
            <?=htmlspecialchars($donnees['msg']) ?> 
    </p>
<?php }

$r1->closeCursor();
?>