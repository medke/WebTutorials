<?php
session_start();
session_destroy();
$titre="Déconnexion";
include("includes/identifiants.php");
include("includes/debut.php");
include("./includes/menu.php");




if ($id=0) erreur(ERR_IS_NOT_CO);

echo '<p> انت الآن غير متصل <br />
اضغط  <a href="'.htmlspecialchars($_SERVER['HTTP_REFERER']).'">هنا</a> 
للرجوع إلى الصفحة السابقة.<br />
و  <a href="./">هنا</a> للرجوع الى صفحة البداية</p>';
?>

</div>
</body>
</html>