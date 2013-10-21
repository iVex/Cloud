<?php include 'includes/bdd.php'; include 'includes/functions.php';
if(isset($_COOKIE['user_id']))
{
    cookietosession($bdd);
}
?>
<!doctype html>
<html>
    <head>
        <title>Cloud</title>
        <link rel="icon" type="image/png" href="../style/img/favicon.png" />
        <link rel="stylesheet" href="../style/style.css">
    </head>
    <body>
    <header>
        <a href="index.php"><img src="../style/img/logo.png"/></a>
        <div class="rubriques">
            <?php
                if(empty($_SESSION['id']) && empty($_SESSION['pseudo'])){
            ?>
            <a href="connection.php">
                <div class="rubrique">
                    Connection
                </div>
            </a>
            <a href="subscription.php">
                <div class="rubrique">
                    Subscription
                </div>
            </a>
            <?php }else{?>
            <a href="profile.php">
                <div class="rubrique">
                    Profile
                </div>
            </a>
            <a href="deconnection.php">
                <div class="rubrique">
                    Deconnection
                </div>
            </a>
            <?php } ?>
        </div>
    </header>
    <div id="content">