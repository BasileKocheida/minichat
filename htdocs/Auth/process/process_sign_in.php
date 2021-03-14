<?php // nouvel utilisateur 


try {
    $pdo = new PDO('mysql:host=mini_chat.loc;dbname=minichat', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}



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


if (empty($_POST["pseudo"])){
    die("Paramètre manquant.");
}

$insertStatement =$pdo->prepare(
    "INSERT INTO user
    (pseudo, password, IP, color)
    VALUES
    (?,?,?, ?)
    ");

$insertStatement->execute([

    $_POST["pseudo"],
    $_POST["password"],
    $_SERVER["REMOTE_ADDR"],
    randomColor()
]);




header('Location: ../login_form.php?message=you are in the register');