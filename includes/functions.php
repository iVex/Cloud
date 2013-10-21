<?php
function crypter($maCleDeCryptage='', $maChaineACrypter){
    if($maCleDeCryptage==''){
        $maCleDeCryptage=$GLOBALS['PHPSESSID'];
    }
    $maCleDeCryptage = md5($maCleDeCryptage);
    $letter = -1;
    $newstr = '';
    $strlen = strlen($maChaineACrypter);
    for($i = 0; $i < $strlen; $i++ ){
        $letter++;
        if ( $letter > 31 ){
            $letter = 0;
        }
        $neword = ord($maChaineACrypter{$i}) + ord($maCleDeCryptage{$letter});
        if ( $neword > 255 ){
            $neword -= 256;
        }
        $newstr .= chr($neword);
    }
    return base64_encode($newstr);
}
function decrypter($maCleDeCryptage='', $maChaineCrypter){
    if($maCleDeCryptage==''){
        $maCleDeCryptage=$GLOBALS['PHPSESSID'];
    }
    $maCleDeCryptage = md5($maCleDeCryptage);
    $letter = -1;
    $newstr = '';
    $maChaineCrypter = base64_decode($maChaineCrypter);
    $strlen = strlen($maChaineCrypter);
    for ( $i = 0; $i < $strlen; $i++ ){
        $letter++;
        if ( $letter > 31 ){
        $letter = 0;
        }
        $neword = ord($maChaineCrypter{$i}) - ord($maCleDeCryptage{$letter});
        if ( $neword < 1 ){
        $neword += 256;
        }
        $newstr .= chr($neword);
    }
    return $newstr;
}
function generer($pseudo, $pass)
{
    $key_base = md5($pseudo).md5($pass);
    $key = sha1($key_base);
    return $key;
}
function cookietosession($bdd)
{
    $req = $bdd->query('SELECT * FROM membres WHERE id = "'.$_COOKIE['user_id'].'"');
    while($resultat = $req->fetch())
    {
        $_SESSION['id'] = $resultat['id'];
        $_SESSION['pseudo'] = $resultat['pseudo'];
    }
}
function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
?>