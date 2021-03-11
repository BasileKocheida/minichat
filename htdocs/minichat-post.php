<?php

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

$message = $_POST['msg']; 
$pseudo = $_POST['pseudo'];

function randomColor(){
    $rgbColor = array();
    
    //Create a loop.
    foreach(array('r', 'g', 'b') as $color){
        //Generate a random number between 0 and 255.
        $rgbColor[$color] = rand(0, 255);
    }
    
    $color = "rgb(".implode(",",$rgbColor).")";
    
    return($color);
    }


$stmt = $pdo->prepare("SELECT * FROM user WHERE pseudo=?");
$stmt->execute([$pseudo]); 
$pseudoVerification = $stmt->fetch(PDO::FETCH_ASSOC);


if ($pseudoVerification) {
    // le nom d'utilisateur existe déjà
    
    $insertMsg =$pdo->prepare(
    "INSERT INTO message_user
    (msg, IdUser)
    VALUES
    (?,?)
    ");

    $insertMsg->execute([

    $_POST["msg"],
    $pseudoVerification["id"]
    ]);
    
} else {
    // le nom d'utilisateur n'existe pas

        $insertUserStatement =$pdo->prepare(
        "INSERT INTO user
        (pseudo,IP, color)
        VALUES
        (?,?, ?)
        ");

       
        $insertUserStatement->execute([
        
            $_POST["pseudo"],
            $_SERVER['REMOTE_ADDR'],
            randomColor()

        ]);
        
        
        
            $lastId = $pdo->lastInsertId();

    
            $insertMsg =$pdo->prepare(
            "INSERT INTO message_user
            (msg, IdUser)
            VALUES
            (?,?)
            ");

            $insertMsg->execute([

            $_POST["msg"],
            $lastId
            ]);

    } 
    setcookie('pseudo', $pseudo, time() + 365*24*3600);
    




