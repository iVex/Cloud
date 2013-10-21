<?php
session_start();
setcookie('user_id', ' ', time() - 3600, '/', 'cloud.loc');
session_destroy();
header('location: index.php');
exit;
?>