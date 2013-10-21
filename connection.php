<?php session_start(); include 'includes/header.php'; ?>
<div id="connection">
    <div class="box">
        <img src="../style/img/connection.png">
    </div>
    <div class="boxform">
        <h2>Connection :</h2>
        <form class="form" method="post">
            <input type="text" class="text" name="text" placeholder="Name"><br/>
            <input type="password" class="pass" name="pass" placeholder="Password"><br/>
            <label for="test" class="checkbox">
                <input type="checkbox" id="test" name="remember">
                <span class="rounded"></span>
                Se Souvenir de moi
            </label>
            <br/>
            <button class="button">Submit</button>
        </form>
    </div>
</div>
<?php
if(!empty($_POST['text']) && !empty($_POST['pass']))
{
    $pseudo = $_POST['text'];
    $pass = $_POST['pass'];
    $key = generer($pseudo, $pass);
    $password = crypter($key, $pass);

    $req = $bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo AND mdp = :pass');
    $req->execute(array(
        'pseudo' => $pseudo,
        'pass' => $password));

    $resultat = $req->fetch();
    if(isset($_POST['remember']))
    {
        setcookie('user_id', $resultat['id'], time() + 3600 * 24 * 3, '/', 'cloud.loc');
    }
    if ($resultat)
    {
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $pseudo;
    }
    if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
    {
        ?>
        <h2><a href="index.php">Vous etes connect&eacute</a></h2>
        <?php
    }
    else if (!$resultat)
    {
        ?>
        <p style="text-align: center;">Mauvaises informations de connexion.</p><br/>
            <?php
    }
}
?>
<?php
include 'includes/footer.php'; ?>