<?php
    session_start();
    include 'includes/header.php';
    ?>
    <div id="subscription">
        <div class="box">
            <img src="../style/img/subscription.png">
        </div>
        <div class="boxform">
            <h2>Subscription :</h2>
            <form class="form" method="post">
                <input class="name" placeholder="Name" type="text" name="name"><br/>
                <input class="pass" placeholder="Password" type="password" name="pass1"><br/>
                <input class="pass" placeholder="Password Check" type="password" name="pass2"><br/>
                <input class="email" placeholder="Mail" type="mail" name="email"><br/>
                <button class="button">Submit</button>
            </form>
        </div>
    </div>
    <?php
    if(!empty($_POST['name']) && !empty($_POST['pass1']) && $_POST['pass1'] === $_POST['pass2'])
    {
        $pseudo = $_POST['name'];
        $pass = $_POST['pass1'];
        $email = $_POST['email'];
        $key = generer($pseudo, $pass);
        $password = crypter($key, $pass);
        $maChaineDecrypter = decrypter($key, $password);
        $null = "NULL";
        $req = 'INSERT INTO membres(id, pseudo, mdp, email, date_inscription, crypt_key) VALUES("'.crypter($key, $null).'", "'.$pseudo.'", "'.$password.'", "'.$email.'", "'.time().'","'.$key.'")';
        $sql = 'SELECT COUNT(*) FROM membres WHERE pseudo = "'.$pseudo.'"';
        $sqlMail = 'SELECT COUNT(*) FROM membres WHERE email = "'.$email.'"';
        if ($res = $bdd->query($sql) and $resMail = $bdd->query($sqlMail))
        {
            if ($res->fetchColumn() > 0)
            {
                ?>
                <p style="text-align: center; margin-left: 50px;">ERREUR: NOM DEJA ENTRE.</p><br />
                <?php
            }
            else if ($resMail->fetchColumn() > 0)
            {
                ?>
                <p style="text-align: center; margin-left: 50px;">ERREUR: MAIL DEJA ENTRE.</p><br />
                <?php
            }
            else
            {
                $ajoutNom = $bdd->query($req);
                if ($ajoutNom)
                {
                    ?>
                    <p style="text-align: center; margin-left: 50px;">Vous êtes désormais inscrits.</p><br />
                    <?php
                    mkdir('uploads/'.$pseudo);
                }
                else
                {
                    ?>
                    <p style="text-align: center; margin-left: 50px;">ERREUR.</p><br />
                    <?php
                }
            }
        }
    }
    ?>
<?php include 'includes/footer.php';