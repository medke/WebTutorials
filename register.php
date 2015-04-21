<?php
function chargerClasse($classname)
    {
        require $classname.'.class.php';
    }
    
    spl_autoload_register('chargerClasse');
	
session_start();
$titre="التسجيل";
include("includes/identifiants.php");
include("includes/debut.php");
include("./includes/menu.php");

echo '<p><i>أنت الآن هنا :</i> : <a href="./">فايندرز</a> --> تسجيل';

$ip=htmlspecialchars($_SERVER['REMOTE_ADDR']);
if ($id!=0) erreur(ERR_IS_CO);
// affichage du formulaire de l iscription
if (empty($_POST['pseudo'])) 
{
	echo '<h1>تسجيل 1/2</h1>';
	echo '<div id="register"><form method="post" action="register.php" enctype="multipart/form-data">
	<fieldset><legend>معلومات</legend>
	<label for="pseudo">* اسم المستعار :</label>  <input name="pseudo" type="text" id="pseudo" />  من 3 إلى 16 حرف<br />
	<label for="password">* كلمة السر :</label><input type="password" name="password" id="password" /><br />
	<label for="confirm">* التأكيد على كلمة السر :</label><input type="password" name="confirm" id="confirm" />
	</fieldset>
	<fieldset><legend>معلومات خاصة</legend>
	<label for="email">* إيمايل :</label><input type="text" name="email" id="email" /><br />
	<label for="msn"> MSN :</label><input type="text" name="msn" id="msn" /><br />
	<label for="website">موقعك :</label><input type="text" name="website" id="website" />
	</fieldset>
	<fieldset><legend>معلومات إضافية</legend>
	<label for="localisation">عنوانك :</label><input type="text" name="localisation" id="localisation" />
	</fieldset>
	<fieldset><legend>معلومات الملف الشخصي</legend>
	<label for="avatar">صورة: </label><input type="file" name="avatar" id="avatar" />(Taille max : 50Ko (100px X 100px))<br />
	<label for="signature">التوقيع:</label><textarea cols="40" rows="3" name="signature" id="signature"></textarea><br/>
	<label for="bio">السيرة :</label><textarea cols="40" rows="6" name="bio" id="bio"></textarea>
	</fieldset>
	<p>مجالات المسبوقة بـ  * إجبارية</p>
	<p><img src="cp.php?'.session_name().'='.session_id().'"></p>
	<p><input type="text" name="keystring"></p>
	<p><input type="submit" id="submit" value="تسجيل" /></p>
	</form>
	</div>
	</body>
	</html>';
	
	
} //Fin de la partie formulaire
else //le cas traitement et tous le if est juste
{ 
 $membre =new membre(array('membre_pseudo'      =>htmlspecialchars($_POST['pseudo']),
                           'membre_mdp'         =>htmlspecialchars($_POST['password']),
						   'membre_mdp_conf'    =>htmlspecialchars($_POST['confirm']),
						   'membre_email'       =>htmlspecialchars($_POST['email']),
						   'membre_msn'         =>htmlspecialchars($_POST['msn']),
						   'membre_siteweb'     =>htmlspecialchars($_POST['website']),
						   'membre_localisation'=>htmlspecialchars($_POST['localisation']),
						   'membre_signature'   =>htmlspecialchars($_POST['signature']),
						   'membre_bio'         =>htmlspecialchars($_POST['bio']),
						   'membre_ip'          =>$ip
						   
                    ));
					
 $membre_manager =new membreManager($db);
 $retour = $membre_manager->getError($membre);
   if (!empty($_FILES['avatar']['size']))
    {
        $retour2=$membre_manager->verif_avatar($_FILES);
    }
 $erreur = $membre_manager->error_m();
 
   if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] ==  $_POST['keystring']){
            
    }
	else{
	$retour=false;
	$erreur=''.$erreur.' تأكد من أنك ملأت كل الفراغات ';
	}
 
 
 
   if($retour==false || ( !empty($_FILES['avatar']['size'])&& $retour2 ==false))
    {
         echo'<br/>'.$erreur;
    }
   else
    {
            echo'<br/>تسجيل ناجح<br/> مرحبا بك  '.$membre->getMembre_pseudo();
		    $id_membre = $membre_manager->addMembre($membre);
			if(!empty($_FILES['avatar']['size']))
			{
                $nomavatar=move_avatar($_FILES['avatar']);
                $membre_manager->update_avatar($nomavatar,$id_membre);
				$icone = new image('images/avatar/'.$nomavatar);
				$icone->width(87);
				$icone->height(96);
				$icone->save();
			}						
    
        
		 $_SESSION['pseudo'] = $membre->getMembre_pseudo();
         $_SESSION['id'] = $id_membre ;
         $_SESSION['level'] = 2;
    }
         
    }
 
 
 return;
 

?>
</div>
</body>
</html>

