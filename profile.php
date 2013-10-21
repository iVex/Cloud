<?php session_start(); include 'includes/header.php';
if(!empty($_SESSION['id'])&& !empty($_SESSION['pseudo']))
{
?>
<div id="profile_top">
    <?php
    $reqId = $bdd->query('SELECT * FROM membres WHERE id = "'.$_SESSION['id'].'"')->fetch();
    $avatar = $reqId['avatar'];
    $pseudo = $reqId['pseudo'];
    $bio = $reqId['Bio'];
    $dir    = 'uploads/'.$pseudo.'/';
    $files = scandir($dir);
    ?>
    <div class="box">
        <img src="uploads/avatar/<?php echo $avatar; ?>">
    </div>
    <div class="desc">
        <p class="p1"><?php echo $pseudo; ?><a href="settings.php"><img src="style/img/settings.png"></a></p><br/>
        <p class="bio"><?php echo $bio; ?></p>
        <a href="addfiles.php">Add some files</a>
    </div>
</div>
<div id="profile_">
    <div class="box">
        <div class="menu">
            <ul>
                <?php for ($i=2; $i < count($files); $i++) {
                    ?><li><form method="post"><input type="submit" name="folder" value="<?php echo $files[$i]; ?>"></form></li><?php
                } ?>
            </ul>
        </div>
    </div>
    <div class="desc">
        <div>
            <p>Files of <?php echo $pseudo; ?></p><br/>
            <div class="menu">
                <?php
                if(!empty($_POST['folder']))
                {
                ?>
                <ul>
                    <?php
                    $dirSelected = $_POST['folder'];
                    $files1 = scandir($dir.$dirSelected);
                    for ($i=2; $i < count($files1); $i++) {
                        ?><li><a href="<?php echo 'uploads/'.$pseudo.'/'.$dirSelected.'/'.$files1[$i]; ?>" download><?php echo $files1[$i]; ?></a></li><?php
                    } ?>
                </ul>
                <?php }else{?>
                <h6>Please, select a folder or add some <a href="#" style="text-decoration: underline;color:#FFF">there</a></h6>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
}
include 'includes/footer.php'; ?>