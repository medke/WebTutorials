<?php
function chargerClasse($classname)
    {
        require $classname.'.class.php';
    }
    
    spl_autoload_register('chargerClasse');
session_start();
$titre="Connexion";
include("includes/identifiants.php");
include("includes/debut.php");



include("./includes/menu.php");
echo '<p><i>أنت الآن هنا :  </i> : <a href="./forum.php">فايندرز</a> --> Connexion';
//debut de la page comme d hbitude
echo '<h1>Connexion</h1>';
//pour enregistrer l url de la derniere page avant la connexion
	


if ($id=0) erreur(ERR_IS_CO);
$page =htmlspecialchars($_SERVER['HTTP_REFERER']);

if (!isset($_POST['pseudo'])) //On est dans la page de formulaire
{
	 echo '<div id="bar_de_con"><form method="post" action="connexion.php">
	 <fieldset>
	 <legend>Connexion</legend>
	 <p>
	 <label for="pseudo">الإسم المتعار :</label><input name="pseudo" type="text" id="pseudo" /><br />
	 <label for="password">كلمة السر :</label><input type="password" name="password" id="password" />
	 </p>
	 </fieldset>
	 <p><input type="submit" id="submit" value="Connexion" /></p></form>
	 <a href="./register.php">غير مسجل بعد ?</a>
	 
    	</div>
    	</body>
	    </html>';
}
else
{
     
     if( empty($_POST['pseudo']) ||  empty($_POST['password']))
     {
         $message = '<p>هناك أخطاء حصلت أثناء محاولة دخولك.
         يجب ملئ كل الفراغات</p>
	     <p>إضغط  <a href="./connexion.php">هنا </a> للرجوع</p>';
     }
    else //On check le mot de passe
    {
	
        $membre = new membre(array('membre_pseudo'=>$_POST['pseudo'],
		                           'membre_mdp'   =>$_POST['password']
								   ));
		$membre_manager = new membreManager($db);
        $retour =$membre_manager->connect($membre);
		
		if($retour==true)
		{
	        $_SESSION['pseudo'] = $membre->getMembre_pseudo();
	        $_SESSION['level'] =  $membre->getMembre_rang();
     	    $_SESSION['id'] =     $membre->getMembre_id();
    	    echo'<p>مرحبا بك  '.$membre->getMembre_pseudo().', 
			أنت الآن عضو بيننا اضغط!</p></p><p>اضغط <a href="'.$page.'">هنا</a> 
    	    للرجوع إلى الصفحة السابقة</p>
			<p>اضغط <a href="./">هنا</a> 
			للرجوع إلى صفحة البداية</p>';  
			
	    }
		else
		{    
		     $erreur =$membre_manager->error_m();
		     echo'<br/>'.$erreur.'<p>اصغط <a href="'.$page.'">هنا </a> 
    	    للرجوع الى الصفحة السابقة </p>
			<p>اضغط <a href="./">هنا</a> 
			للرجوع إلى صفحة البداية</p>';
			 
		}
		
	}	
    echo '</div></body></html>';
    

}
?>

</body>
</html>






