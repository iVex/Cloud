<div class="first">
    <div class="box">
        <img src="../style/img/cloud.png">
    </div>
    <div class="desc">
        <p id="p1">Welcome on my Cloud.</p><p id="p2"> It's a cool place to store folders and files.</p>
    </div>
</div>
<div class="second">
    <div class="box"></div>
    <div class="desc">
        <div class="texte">
            <h1>Here we are, In my database.</h1>
            <?php if(empty($_SESSION['id']) && empty($_SESSION['pseudo'])) {?>
            <p>Connect to see your files.</p>
            <?php }else if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo'])){?>
            <p>Welcome, <?php echo $_SESSION['pseudo']; ?>
            <?php } ?>
        </div>
    </div>
</div>