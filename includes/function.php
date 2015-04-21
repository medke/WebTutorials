<?php
function erreur($err='')
{
   $mess=($err!='')? $err:'هناك خطأ حدث';
   exit('<p>'.$mess.'</p>
   <p>اضغط <a href="./index.php">هنا</a> للرجوع الى صفحة البداية</p></div></body></html>');
}
function move_avatar($avatar)
{
    $extension_upload = strtolower(substr(  strrchr($avatar['name'], '.')  ,1));
    $name = time();
    $nomavatar = str_replace(' ','',$name).".".$extension_upload;
    $name = "./images/avatars/".str_replace(' ','',$name).".".$extension_upload;
    move_uploaded_file($avatar['tmp_name'],$name);
    return $nomavatar;
}
function verif_auth($auth_necessaire){
$lvl   =(isset($_SESSION['level']))?(int)$_SESSION['level']:1;
return ($auth_necessaire <= intval($lvl));

}




?>
