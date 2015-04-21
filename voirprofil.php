<?php
function chargerClasse($classname)
    {
        require $classname.'.class.php';
    }
    
    spl_autoload_register('chargerClasse');
session_start();
$titre="الملف الشخصي";
include("includes/identifiants.php");
include("includes/debut.php");

include("./includes/menu.php");
//On récupère la valeur de nos variables passées par URL
$action = isset($_GET['action'])?htmlspecialchars($_GET['action']):'consulter';
$membre = isset($_GET['m'])?(int) $_GET['m']:'';
//On regarde la valeur de la variable $action
switch($action)
{
    //Si c'est "consulter"
    case "consulter":
	
	     $membre_manager = new membreManager($db);
		 $membre = new membre(array('membre_pseudo'=>$membre));
		 $membre_manager->afficher_membre($membre);
	   
	   
 if($membre->getMembre_pseudo() !=""){
 
     
 
       //On affiche les infos sur le membre
       echo '<p><i>أنت الآن هنا :</i> : <a href="./index.php">فايندرز</a> --> 
       الملف الشخصي لـ '.stripslashes(htmlspecialchars($membre->getMembre_pseudo()));
       echo'<h1>الملف الشخصي لـ '.stripslashes(htmlspecialchars($membre->getMembre_pseudo())).'</h1>';
       ?><div id="profil"><?php
       echo'<img src="./images/avatars/'.$membre->getMembre_avatar().'"
       alt="هدا العضو لايملك صورة" />';
      
       echo'<p><strong>البريد الإلكتروني : </strong>
       <a href="mailto:'.stripslashes($membre->getMembre_email()).'">
       '.stripslashes(htmlspecialchars($membre->getMembre_email())).'</a><br />';
       
       echo'<strong>آم أس أن : </strong>'.stripslashes(htmlspecialchars($membre->getMembre_msn())).'<br />';
       
       echo'<strong>موقعك : </strong>
       <a href="'.stripslashes($membre->getMembre_siteweb()).'">'.stripslashes(htmlspecialchars($membre->getMembre_siteweb())).'</a>
       <br />';
       echo'عضو مند
       <strong>'.date('d/m/Y',$membre->getMembre_inscrit()).'</strong>
       أضاف  <strong>'.$membre->getMembre_post().'</strong> مشاركة
       </div><br /><br />';
       echo'<div id="profil_loc"><strong>العنوان : </strong>'.stripslashes(htmlspecialchars($membre->getMembre_localisation())).'
       </div><br/></p>';
	   echo'<div id="profil_sig"><strong>التوقيع : </strong><br/>'.stripslashes(htmlspecialchars($membre->getMembre_signature())).'
       </div><br/><br/></p>';
	   echo'<div id="profil_bio"><strong>السيرة : </strong><br/>'.stripslashes(htmlspecialchars($membre->getMembre_bio())).'
       </div></p>'; }
	   
	   
 else
{
 echo"لا توجد صفحة بهدا الرابط";
 }
 
       
       break;
//Si on choisit de modifier son profil
    case "modifier":
    if (empty($_POST['sent'])) // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
    {
        //On commence par s'assurer que le membre est connecté
        if ($id==0) erreur(ERR_IS_NOT_CO);
        $membre_manager = new membreManager($db);
		$membre = new membre(array('membre_id'=>$id)); 
		$membre_manager->info_membre($membre);
       
        echo '<p><i>أنت الآن هنا :</i> : <a href="./index.php">فايندرز</a> --> تعديل الملف الشخصي';
        echo '<h1>تعديل ملف الشخي لأـ '. stripslashes(htmlspecialchars($membre->getMembre_pseudo())).'</h1>';
        
        echo '<form method="post" action="voirprofil.php?action=modifier" enctype="multipart/form-data">
       
 
        
             
       
 
        <fieldset><legend>معلومات خاصة</legend>
        <label for="email">بريدك الإلكتروني :</label>
        <input type="text" name="email" id="email"
        value="'.stripslashes($membre->getMembre_email()).'" /><br />
 
        <label for="msn">آم آس آن :</label>
        <input type="text" name="msn" id="msn"
        value="'.stripslashes($membre->getMembre_msn()).'" /><br />
 
        <label for="website">موقعك :</label>
        <input type="text" name="website" id="website"
        value="'.stripslashes($membre->getMembre_siteweb()).'" /><br />
        </fieldset>
 
        <fieldset><legend>معلومات إضافية</legend>
        <label for="localisation">العنوان :</label>
        <input type="text" name="localisation" id="localisation"
        value="'.stripslashes($membre->getMembre_localisation()).'" /><br />
        </fieldset>
               
        <fieldset><legend>الملف الشخصي</legend>
        <label for="avatar">تغيير الصورة :</label>
        <input type="file" name="avatar" id="avatar" />
        (Taille max : 10 ko)<br /><br />
        <label><input type="checkbox" name="delete" value="Delete" />
        حدف الصورة</label>
        الصورة الحالية :
        <img src="./images/avatars/'.$membre->getMembre_avatar().'"
        alt="لا يوجد صورة" />
     
        <br /><br />
        <label for="signature">التوقيع :</label>
        <textarea cols="40" rows="4" name="signature" id="signature">
        '.stripslashes($membre->getMembre_signature()).'</textarea><br/>
		<label for="bio">السيرة :</label>
		<textarea cols="40" rows="4" name="bio" id="bio">
        '.stripslashes($membre->getMembre_bio()).'</textarea>
     
     
        </fieldset>
        <p>
        <input type="submit" id="submit" value="تعديل الملف الشخصي" />
        
            <input type="hidden" id="sent" name="sent" value="1" />
        </p></form>';
         
    }   
    else //Sinon on est dans la page de traitement
    {

	$membre = new membre(array('membre_signature'   =>$_POST['signature'],
	                           'membre_id'          =>$id,
	                           'membre_email'       =>$_POST['email'],
							   'membre_msn'         =>$_POST['msn'],
							   'membre_siteweb'     =>$_POST['website'],
							   'membre_localisation'=>$_POST['localisation'],
							   'membre_bio'         =>$_POST['bio']
	                           ));
	$membre_manager = new membreManager($db); 
    $retour =$membre_manager->modif_membre($membre);
        if (!empty($_FILES['avatar']['size']))
        {
           $retour2=$membre_manager->verif_avatar($_FILES);
     	}
        echo '<p><i>أنت الآن هنا :</i> : <a href="./index.php">فايندرز</a> --> تعديل الملف الشخصي';
    echo '<h1>تعديل الملف الشخصي</h1>';

 
   if($retour==false || ( !empty($_FILES['avatar']['size'])&& $retour2 ==false))
    {   
        echo'<h1>خطأ في التعديل</h1>';
        echo'<p>خطأ أو أكثر  في ملئ الفراغات</p>';
        echo'<p>'.$membre_manager->error_m().'</p>';
        echo'<p> اضغط <a href="./voirprofil.php?action=modifier">هنا</a> لإعادة المحاولة</p>';}
    else
    {
	    $nomavatar=move_avatar($_FILES['avatar']);
        $membre_manager->update_avatar($nomavatar,$id);
		
 
        //Une nouveauté ici : on peut choisis de supprimer l'avatar
        if (isset($_POST['delete']))
        {
            $membre_manager->del_avatar($id);
        }
 
        echo'<h1>تعديل ناجح</h1>';
        echo'<p>ملفك الشخصي عدل بنجاح !</p>';
        echo'<p>اضغط  <a href="./index.php">هنا</a> 
        للرجوع الى صفحة البداية</p>';
 
        $membre_manager->update_membre($membre);
    }
} //Fin du else
    break;
 case "modifier_mdp":
 if (empty($_POST['sent'])){
   if ($id==0) erreur(ERR_IS_NOT_CO);
   
		
 echo '<form method="post" action="voirprofil.php?action=modifier_mdp" enctype="multipart/form-data">
       
 
        <fieldset><legend>معلومات</legend>
         <label for="ancien">كلمة السر القديمة:   </label>
        <input type="password" name="ancien" id="ancien" /><br />
        <label for="password">كلمة السر الجديدة:   </label>
        <input type="password" name="password" id="password" /><br />
        <label for="confirm">تأكيد كلمة السر الجديدة :</label>
        <input type="password" name="confirm" id="confirm"  />
        </fieldset>
		<input type="submit" id="submit" value="تعديل كلمة السر" />
        <input type="hidden" id="sent" name="sent" value="1" />
		';
		} else{
		 $membre = new membre(array('membre_id'=>$id,
		                            'membre_mdp'=>stripslashes(htmlspecialchars($_POST['password'])),
									'membre_mdp_conf'=>stripslashes(htmlspecialchars($_POST['confirm'])),
									));
		 $membre_manager = new membreManager($db);
		 $passan=stripslashes(htmlspecialchars($_POST['ancien']));
		 $retour =$membre_manager->verif_mdp($membre,$passan);
		
		if ($retour == true) // Si $i est vide, il n'y a pas d'erreur
        {
		 echo'<h1>تعديل ناجح</h1>';
         echo'<p>كلمة السر عدلت بنجاح !</p>';
         echo'<p>اضغط <a href="./index.php">هنا</a> 
         للرجوع الى صفحة البداية</p>';
		 $membre_manager->update_mdp($membre);
		
		}else
        {
        echo'<h1>خطأ في التعديل</h1><p><br/>'.$membre_manager->error_m().'</p>
		<p><br/> اضغط  <a href="./voirprofil.php?action=modifier_mdp">هنا</a> لإعادة المحاولة</p>';
		
        }
	}  
 
 break;
default; 
echo'<p>آسف ,هده العملية مستحيلة</p>';
 
} //Fin du switch
?>
</div>
</body>
</html>
</html>


   