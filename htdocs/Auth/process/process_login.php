<?php // connecter l'utilisateur 

session_start();

try {
    $pdo = new PDO('mysql:host=mini_chat.loc;dbname=minichat', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}



if (empty($_POST["pseudo"])) {
    die("Paramètres manquants");
}

$_SESSION["pseudo"] = $_POST["pseudo"];
$_SESSION["password"] = $_POST["password"];

if (isset($_SESSION['pseudo'])) {

    $nickname = $_SESSION['pseudo'];
    
    $req = $pdo->prepare('SELECT * FROM user WHERE pseudo = ?');
    
    $req->execute(array(
        $nickname));
        $resultat = $req->fetch();
        
        $id = $resultat['id'];
        
        if ($resultat['pseudo'] === $nickname && $resultat['password'] === $_SESSION['password']) {
            setcookie('cookiePseudo', $resultat['pseudo'],  time()+3600);
            header('Location: ../../minichat.php?message=Salut '.$nickname.' tu es connecté a ton compte !&id='.$id.'');
            
        }
        
        else {
            header('Location: ../login_form.php?message=pseudo ou mot de passe faux !');
        }
}
?>