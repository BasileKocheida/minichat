<?php
session_start();
var_dump($_SESSION);
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
$pseudo = $_SESSION['pseudo'];

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

    $message,
    $pseudoVerification["id"]
    
    ]);
    
} else {
    // le nom d'utilisateur n'existe pas

        echo "Please connect to chat";

    } 
    
    




