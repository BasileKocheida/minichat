<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="/customa.css" rel="stylesheet">
    <title>MINICHAT</title>
</head>

<body>
<nav>
    <div class="nav-wrapper #283593 indigo darken-3">
      <a href="#!" class="brand-logo"><i class="material-icons">child_care</i>MINICHAT</a>
      <ul class="right hide-on-med-and-down">
       

        <?php if (isset($_SESSION['pseudo'])){ ?>
            <li><a href="/Auth/process/deco_login.php"><i class="material-icons">grid_off</i></a></li>
         <?php }else{ ?>
            <li><a href="/Auth/sign_in_form.php"><i class="material-icons">group_add</i></a></li>
            <li><a href="/Auth/login_form.php"><i class="material-icons">settings_power</i></a></li>
        <?php } ?>
        
        
        <li><a href="/minichat.php"><i class="material-icons">view_module</i></a></li>
      </ul>
    </div>
  </nav>