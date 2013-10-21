<?php session_start(); include 'includes/header.php';
$reqId = $bdd->query('SELECT * FROM membres WHERE id = "'.$_SESSION['id'].'"')->fetch();
$pseudo = $reqId['pseudo'];
?>
<div id="addform">
    <div class="box">
        <p><?php echo $pseudo.': '; ?></p>
    </div>
    <div class="desc">
        <form method="post" enctype="multipart/form-data">
            <p class="p1">Add files: </p><br />
            <input type="text" name="foldername" placeholder="The name of the folder">
            <input name="userfile[]" type="file" class="files" multiple>
            <button type="submit">Submit the files</button>
        </form>
    </div>
</div>
<?php
if (!empty($_FILES['userfile']) && !empty($_POST['foldername'])) {
    $userfile = $_FILES['userfile'];
    $dirTmp = $_POST['foldername'];
    $dir = 'uploads/'.$pseudo.'/'.$dirTmp;
    $arrayFiles = reArrayFiles($_FILES['userfile']);
    if (!file_exists($dir)) {
        mkdir($dir);
    }
    for ($i=0; $i < count($arrayFiles); $i++) {
        if($i >= count($arrayFiles)){
            break;
        }
        $file = basename($_FILES['userfile']['name'][$i]);
        $file = strtr($file,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ-3','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy  ');
        $file = preg_replace('/([^.a-z0-9]+)/i', '-', $file);
        if(move_uploaded_file($_FILES['userfile']['tmp_name'][$i], $dir.'/'.$file))
        {
            echo 'File uploaded :'.$file.'<br/>';
        }
        else
        {
            echo 'Error!'.'<br/>'.'The file is too weight';
        }
        if($i >= count($arrayFiles)){
            break;
        }
    }
}
include 'includes/footer.php'; ?>