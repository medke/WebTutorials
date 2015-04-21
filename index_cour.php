<?php
session_start();

function chargerClasse($classname)
    {
        require $classname.'.class.php';
    }
    
    spl_autoload_register('chargerClasse');
    
     // On appelle session_start() APR?S avoir enregistr? l'autoload
    $titre="دروس";
	$balises = true;
    include("includes/identifiants.php");
    include("includes/debut.php");
    include("./includes/menu.php");
	include("./includes/mcode.php");
	if ($id==0) erreur('لا تستطيع الدخول الى هده الصفحة حاليا');
	$lien='';


    
    if (isset($_GET['deconnexion']))
    {
        session_destroy();
        header('Location: .');
        exit();
    }
	
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$coura = new courManager($db);
	
	if(isset($_POST['creer'])){
	     if((strlen($_POST['titre'])>2) && isset($_POST['intro'])  && isset($_POST['type'])&& isset($_POST['lge']))
		 {
		    $cour =new cour(array('titre'     => htmlspecialchars($_POST['titre']),
			                      'intro'     => htmlspecialchars($_POST['intro']),
								  'conclusion'=> htmlspecialchars($_POST['conclusion']),
								  'type'      => htmlspecialchars($_POST['type']),
								  'lge'       => htmlspecialchars($_POST['lge']),
								  'hauteur'   => htmlspecialchars($_SESSION['pseudo']) ));
			    if(!empty($_FILES['icone']['size']))
			    {
			        $retour2=$coura->verif_avatar($_FILES);
			    }
				else
				{
				    $retour2=true;
				}
			     if($coura->isValid($cour) )
				 {   
					  
			          $coura->add($cour);
					  /*
                        if(!empty($_FILES['icone']['size']))
                        {   
						    $nomavatar=move_avatar($_FILES['icone']);
						    $coura->update_avatar($nomavatar,$cour);
							$icone = new image('images/icone/'.$nomavatar);
							$icone->width(29);
							$icone->height(32);
							$icone->save();
						}		
                      */						
			          $donnes = $coura->getlist($cour);
			          $retour=$cour->affichage($donnes,$cour);
					  echo $retour;
					  
			         
			          return $retour;
		         }
		 }
		 else{
		 
		     echo"impossible";
		 }
	
	  
	}
		if(isset($_POST['modif']))
	{
 
		    $cour =new cour(array('titre'     => htmlspecialchars($_POST['titre']),
			                      'intro'     => htmlspecialchars($_POST['intro']),
								  'conclusion'=> htmlspecialchars($_POST['conclusion']),
								  'type'      => htmlspecialchars($_POST['type']),
								  'lge'       => htmlspecialchars($_POST['lge']),
								  'hauteur'   => htmlspecialchars($_SESSION['pseudo']) ));
		    $coura->update($cour);		
                         			
			$donnes = $coura->getlist($cour);
			$retour=$cour->affichage($donnes,$cour);
			echo $retour;
			return $retour;
		         
		 

	
	
	
	
	}
	if(isset($_GET['t']) )
	{
	/*
	--------------------------------modifier un cour ----------------------------------------------------
	*/
	     $id = (int)$_GET['t'];
		 $haut =(string)htmlspecialchars($_GET['h']);
	     if($haut!= $_SESSION['pseudo'] || $coura->cour_existe($id,$haut)==false){
             echo'غير ممكن';
	         header('Location: .');
              exit();
	 
	    }
		else
		{
	      $cour =new cour(array('id'     => htmlspecialchars($id),
		                        'hauteur'   => htmlspecialchars($_SESSION['pseudo']) ));				
			$donnes = $coura->getcour($cour);
			
			
			foreach($donnes as $key=>$val)
			  {
			     echo '<h2>تعديل درس</h2><form action="" method="post">
		         <fieldset>
		         <p>
			     <label for="titre">عنوان</label><input type="text" id="titre" name="titre" value="'.$val['titre'].'" /><br/>
				 <label for="intro">مقدمة</label><textarea name="intro" id="intro" rows="8" cols="45">'.$val['intro'].'</textarea><br/>
				 <label for="conclusion">خاتمة</label><textarea name="conclusion" id="conclusion" rows="8" cols="45">'.$val['conclusion'].'</textarea><br/>
				 نوع   
				 <select name="type">
                    <option value="prog">برمجة</option>
                    <option value="progweb">برمجة الويب</option>
                    <option value="infog">جرافيك</option>
					<option value="autre">آخر</option>
                 </select><br/>
				 <label for="lge">لغة البرجة</label><input type="text" id="lge" name="lge" value="'.$val['lge'].'"/><br/>
				  <label for="icone">صورة: </label><input type="file" name="icone" id="icone" />( 50Ko (100px X 100px))<br/>
			      <input type="submit" class="submit" value="تعديل هدا الدرس" name="modif" />
				  
			     </p>
		  
		         </fieldset>	  
		          </form>';
			  }
			  
			return $donnes;
	    }
	
	}
     if(isset($_GET['s']) )
	{
	/*
	------------------------------------------------------supprimer un cour --------------------------------------------------
	
	*/
	     $id = (int)$_GET['s'];
		 $haut =(string)htmlspecialchars($_GET['h']);
	     if($haut!= $_SESSION['pseudo']|| $coura->cour_existe($id,$haut)==false){
             echo'غير ممكن';
	         header('Location: .');
              exit();
	 
	    }
		else
		{ 
	      $cour =new cour(array('id'     => htmlspecialchars($id),
		                        'hauteur'   => htmlspecialchars($_SESSION['pseudo']) ));
		  $coura->delcour($cour);
		  $donnes = $coura->getlist($cour);
		  $retour=$cour->affichage($donnes,$cour);
		  echo $retour;
		  return $retour;
			 
	    }
	
	}
	 if(isset($_GET['v']) )
	{    
	/*
	------------------------------------afficher un cour -------------------------------------------------------------
	*/
	     $partie = array();
	     $id = $_GET['v'];
		 $haut =(string)htmlspecialchars($_GET['h']);
		 $intro='';$conc='';$type='';$lge;$tm_cr;$tm_upd;
		 
		 
	     if($haut!= $_SESSION['pseudo'] || $coura->cour_existe($id,$haut)==false)
		{
             echo'غير ممكن';
	         header('Location: .');
              exit();
	 
	    }
		else
		{
		  $message='';
	      $cour =new cour(array('id'     => $id,
		                        'hauteur'   => htmlspecialchars($_SESSION['pseudo']) ));
		  $donnes =$coura->getcour($cour);
		  $donnes2 =$coura->countpartie($cour);
		  
		   if($donnes2['nbp'] != 0)
			{
		         $donnes3=$coura->getpartie($cour);
				 foreach($donnes3 as $key=>$val)
			        {
					     
						 $part[]= $val['id'];
						 $titre_p[]= $val['titre'];
                         				 
				    }
		         
		  
		    }
			else
			{
			     $message ='هذا الدرس لا يحتوي على أي جدء حاليا';
			}
		           foreach($donnes as $key=>$val)
			        {
					     $intro =$val['intro'];
                         $conc  =$val['conclusion']	;
						 $titre=$val['titre']	;
                         						 
				    }
			$lien=isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : 'mes_tuto.html';
			echo '<p><a href="'.$lien.'">الرجوع للوراء</a></p>';
		  $contenu='<div id="intro_c">
                    <div id="t_cour">  
					<h1 style="color:#8096c8;">'.$titre.'</h1>
					<p>'.nl2br($intro).'</p>
					</div>
					</div>
					
					<div id="cour">
                    <p>
                    <hr/></p>
                    <ul id="sommaire">
                    <h2>فهرس</h2>';
					
					for($i=0; $i<$donnes2['nbp'];$i++)
                    {     
					     $titre2 =array();
					      $partie =new partie(array('id'      =>$part[$i],
						                           'titre'   =>$titre_p[$i],
						                           'cour'    =>$id,
												   'hauteur' =>$_SESSION['pseudo']));
						 $nbrch =$coura->countchapitre($partie);
						 
					     $contenu=''.$contenu.' <h3>'.$partie->titre().'</h3>';
						 
						      if($nbrch[0]!=0)
						    {
							     $contenu=''.$contenu.' <ol>';
							     $chapitre2 =$coura->getchapitre($partie);
								 		foreach($chapitre2 as $key=>$val)
			                            {
					                       
                                           $titre2[]  =$val['titre'];
                                           $id_ch[]	  =$val['id']	;										   				 

										    $contenu =''.$contenu.'<li><a href="index_cour.php?affich_ch='.$val['id'].'&h='.$cour->hauteur().'&p='.$partie->id().'&co='.$partie->cour().'"">'. $val['titre'].'</a></li>';				 
										} 
										$contenu=''.$contenu.' </ol>';
										
								 
							}
					     
					 				
					}
					
					
		  echo($contenu);
		  return ;
	
	    }
	}
	 if(isset($_GET['e']) )
	{
	/*
	------------------------------------------------------ecrire un cour ------------------------------------
	
	*/
	     $id = (int)$_GET['e'];
		 $haut =(string)htmlspecialchars($_GET['h']);
		 $intro='';$conc='';$type='';$lge;$tm_cr;$tm_upd;
		 
		 
	     if($haut!= $_SESSION['pseudo'] || $coura->cour_existe($id,$haut)==false){
             echo'غير ممكن';
	         header('Location: .');
              exit();
	     }
		else
		{
		  $message='';
	      $cour =new cour(array('id'     => htmlspecialchars($id),
		                        'hauteur'   => htmlspecialchars($_SESSION['pseudo']) ));
		  $donnes =$coura->getcour($cour);
		  $donnes2 =$coura->countpartie($cour);
		  
		   if($donnes2['nbp'] != 0)
			{
		         $donnes3=$coura->getpartie($cour);
				 foreach($donnes3 as $key=>$val)
			        {
					     $part[]= $val['id'];
						 $titre_p[]= $val['titre'];
                         				 
				    }
		         
		  
		    }
			else
			{
			     echo 'هذا الدرس لا يحتوي على أي جدء حاليا';
			}
		           foreach($donnes as $key=>$val)
			        {
					     $intro =$val['intro'];
                         $conc  =$val['conclusion']	;					 
				    }
			$lien=isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : 'mes_tuto.html';
			echo '<p><a href="'.$lien.'">الرجوع للوراء</a></p>';
		   $contenu='
                    <table>
                    <tr><th>فهرس</th><th></th><th></th> <td> <a href="index_cour.php?ap='.$id.'&h='.$cour->hauteur().'">إضافة جزء</a></td><td></td><td></td></tr>';
					
					for($i=0; $i<$donnes2['nbp'];$i++)
					
                    {     
					     $titre2 =array();
					     $partie =new partie(array('id'      =>$part[$i],
						                           'titre'   =>$titre_p[$i],
						                           'cour'    =>$id,
												   'hauteur' =>$_SESSION['pseudo']));
						 $nbrch =$coura->countchapitre($partie);
						 
					     $contenu=''.$contenu.'   <tr> <th></th><th>'.$partie->titre().' '.$message.'</th><th></th><td><a href="index_cour.php?ach='.$partie->id().'&h='.$cour->hauteur().'&co='.$id.'">إضافة فصل</a></td>
						 <td><a  href="index_cour.php?ren_p='.$partie->id().'&h='.$cour->hauteur().'&co='.$id.'"> إعادة تسمية </a></td>
						 <td><a  href="index_cour.php?sup_p='.$partie->id().'&c='.$id.'&h='.$cour->hauteur().'&co='.$id.'">--- حذف</a></td></tr>';
						 
						     	 if(isset($_GET['sup_p']) )
	                            {
								  echo 'تم الحذف' ;
								}
						      if($nbrch[0]!=0)
						    {
							     
							     $chapitre =$coura->getchapitre($partie);
								 		foreach($chapitre as $key=>$val)
			                            {
										    $contenu =''.$contenu.'<tr><th></th><th></th><th><a href="index_cour.php?affich_ch='.$val['id'].'&h='.$cour->hauteur().'&p='.$partie->id().'&co='.$partie->cour().'">'.$val['titre'].'</a></th><td><a href="index_cour.php?em_ch='.$val['id'].'&h='.$cour->hauteur().'&p='.$partie->id().'&co='.$partie->cour().'">كتابة أو تعديل</a></td>
											<td><a href="index_cour.php?supp_ch='.$val['id'].'&h='.$cour->hauteur().'&p='.$partie->id().'&co='.$partie->cour().'">--- حذف </a></td><td></td></tr>';				 
										} 
										
										
								 
							}
							else{
							  $contenu =''.$contenu.'<tr><th></th><th></th><th></th><td></td><td></td><td></td><td style="font-size:75%; color:grey;">هذا الجزء لايحتوي على أي فصل</td>';
							}
					     
					 				
					}
					
		  $contenu=''.$contenu.' </table>';		
		  echo($contenu);
		  return ;
	
	    }
	
	
	
	}
	 if(isset($_GET['affich_ch']) )
	{	
	     $chapitre_supp = $_GET['affich_ch'];
		 $cour =$_GET['co'];
		 $part =$_GET['p'];
		 $haut =(string)htmlspecialchars($_GET['h']);
		 
	     if($haut!= $_SESSION['pseudo'] || $coura->chapt_existe($chapitre_supp,$haut)==false){
             echo'غير ممكن';
	         header('Location: .');
              exit();	    
	     }
		 else
		 { 
		    $chapitre = new chapitre(array('id'    =>$chapitre_supp,
										    'partie'=>$part,
									        'cour'  =>$cour,
									        'hauteur'=>$haut    ));
            
			
			$affich= $coura->get_chapt($chapitre);
			$lien=isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : 'mes_tuto.html';
			echo '<p><a href="'.$lien.'">الرجوع للوراء</a></p>';
			echo '<div id="corp">'.zcode($affich).'</div>' ;
	   return;
	    }
	}
    if(isset($_GET['supp_ch']) )
	{	
	     $chapitre_supp = (int)$_GET['supp_ch'];
		 $cour =$_GET['co'];
		 $part =$_GET['p'];
		 $haut =(string)htmlspecialchars($_GET['h']);
		 
	     if($haut!= $_SESSION['pseudo']  ){
             echo'غير ممكن';
	         
              exit();	    
	     }
		 else
		 { 
		    $chapitre = new chapitre(array('id'    =>$chapitre_supp,
										    'partie'=>$part,
									        'cour'  =>$cour   ));
		    
		     $coura->supprimer_chapt($chapitre);
			 echo'le chapitre a supprimer avec succes';
			 			   	$lien='index_cour.php?e='.$chapitre->cour().'&h='.$_SESSION['pseudo'];
				  echo'<p><a href="'.$lien.'">اضغط هنا للرجوع للوراء</a></p>';
		 
		 }  	
	   return;
	}
    if(isset($_GET['em_ch']) )
	{
	     $chapitre_anc = (int)$_GET['em_ch'];
		 $haut =(string)htmlspecialchars($_GET['h']);
		 $cour =(int)$_GET['co'];
		 $part =(int)$_GET['p'];


		 
		 
					
					
		 
	     if($haut!= $_SESSION['pseudo']  ){
             echo'غير ممكن';
	         header('Location: .');
              exit();	    
	     }
		 else
		 {   
		 
         $q =$db->query('SELECT contenu,titre FROM chapitre  WHERE cour="'.$cour.'" AND partie="'.$part.'" AND id="'.$chapitre_anc.'" AND hauteur="'.$haut.'" ');

		 $data=$q->fetch();
		 $donnes=htmlspecialchars($data['contenu']);
		 $title=htmlspecialchars($data['titre']);
                   
		    if(isset($_POST['modif_chapt']) && !empty($_POST['contenu_ch']) && !empty($_POST['name_ch']))
			{
		       $chapitre = new chapitre(array('titre'  =>htmlspecialchars($_POST['name_ch']),
			                                  'contenu'=>htmlspecialchars($_POST['contenu_ch']),
			                                  'id'    =>$chapitre_anc,
										      'partie'=>$part,
										      'cour'  =>$cour,
										      'hauteur'=>$haut    ));
											  
			   $coura->update_chapt($chapitre);
			   echo'تم تعديل الفصل بنجاح';
			   	$lien='index_cour.php?e='.$chapitre->cour().'&h='.$_SESSION['pseudo'];
				  echo'<p><a href="'.$lien.'">اضغط هنا للرجوع للوراء</a></p>';
		  
		    }
			 else
			 {
             
			 echo'<form action="" method="post" name="formulaire">
			 <fieldset>
			 <label for="name_ch">العنوان</label><input type="text" value="'. $title .'"id="titre" name="name_ch"/><br/>
			 </fieldset>
			 <fieldset><legend>التنسيق</legend>';
			 ?>
<input type="button" id="gras" name="gras" value="غليظ" onClick="javascript:bbcode('[g]', '[/g]');return(false)" />
<input type="button" id="italic" name="italic" value="مائل" onClick="javascript:bbcode('[i]', '[/i]');return(false)" />
<input type="button" class="choix" name="souligne" value="مسطر" onClick="javascript:bbcode('[s]', '[/s]');return(false)" />
<input type="button" id="lien" name="lien" value="رابط" onClick="javascript:bbcode('[url]', '[/url]');return(false)" />
<input type="button" id="image" name="image" value="صورة" onClick="javascript:bbcode('[img]', '[/img]');return(false)" />

<select class="choix">
<option  >كود</option>
<option  id="php" name="php" value="php" onClick="javascript:bbcode('<code=php>', '</code>');return(false)">php</option>
<option  id="java" name="java" value="java" onClick="javascript:bbcode('<code=java>', '</code>');return(false)">java</option>
<option  id="html" name="html" value="html" onClick="javascript:bbcode('<code=xhtml>', '</code>');return(false)">(x)html</option>
<option  id="css" name="css" value="css" onClick="javascript:bbcode('<code=css>', '</code>');return(false)">css</option>
<option  id="sql" name="sql" value="sql" onClick="javascript:bbcode('<code=sql>', '</code>');return(false)">sql</option>
<option  id="C" name="C" value="C" onClick="javascript:bbcode('<code=c>', '</code>');return(false)">C</option>
<option  id="C++" name="C++" value="C++" onClick="javascript:bbcode('<code=c++>', '</code>');return(false)">C++</option>

</select>
<select class="choix">
<option  >لون</option>
<option style="color:red" id="red" name="red" value="أحمر" onClick="javascript:bbcode('[color=red]', '[/color]');return(false)">أحمر</option>
<option  style="color:blue" id="bleu" name="bleu" value="أزرق" onClick="javascript:bbcode('[color=blue]', '[/color]');return(false)">أزرق</option>
<option  id="black" name="black" value="أسود" onClick="javascript:bbcode('[color=black]', '[/color]');return(false)">أسود</option>
<option  style="color:green" id="green" name="أخضر" value="green" onClick="javascript:bbcode('[color=green]', '[/color]');return(false)">أخضر</option>
<option  style="color:orange" id="orange" name="برتقالي" value="orange" onClick="javascript:bbcode('[color=orange]', '[/color]');return(false)">برتقالي</option>

</select>

<select class="choix">
<option >حجم</option>
<option  style="font-size:80%"    value="petit" onClick="javascript:bbcode('[size=6]', '[/size]');return(false)">صغير جدا</option>
<option  style="font-size:90%"    value="tres petit" onClick="javascript:bbcode('[size=5]', '[/size]');return(false)">صغير</option>
<option  style="font-size:110%"   value="grand" onClick="javascript:bbcode('[size=4]', '[/size]');return(false)">عادي</option>
<option  style="font-size:120%"    value="tres grand" onClick="javascript:bbcode('[size=3]', '[/size]');return(false)">كبير</option>
<option  style="font-size:140%"    value="tres tres grand" onClick="javascript:bbcode('[size=2]', '[/size]');return(false)">كبير جدا</option>


</select>




<br /><br />
<img src="./images/smileys/heureux.gif" title="heureux" alt="heureux" onClick="javascript:smilies(' :D ');return(false)" />
<img src="./images/smileys/lol.gif" title="lol" alt="lol" onClick="javascript:smilies(' :lol: ');return(false)" />
<img src="./images/smileys/triste.gif" title="triste" alt="triste" onClick="javascript:smilies(' :triste: ');return(false)" />
<img src="./images/smileys/cool.gif" title="cool" alt="cool" onClick="javascript:smilies(' :frime: ');return(false)" />
<img src="./images/smileys/rire.gif" title="rire" alt="rire" onClick="javascript:smilies(' :rire:');return(false)" />
<img src="./images/smileys/confus.gif" title="confus" alt="confus" onClick="javascript:smilies(' :s ');return(false)" />
<img src="./images/smileys/choc.gif" title="choc" alt="choc" onClick="javascript:smilies(' :o ');return(false)" />
<img src="./images/smileys/question.gif" title="?" alt="?" onClick="javascript:smilies(' :interrogation: ');return(false)" />
<img src="./images/smileys/exclamation.gif" title="!" alt="!" onClick="javascript:smilies(' :exclamation: ');return(false)" />
</fieldset>
 <?php
echo'<fieldset><legend>Contenue Du Chapitre</legend><textarea cols="80" rows="40" id="message" name="contenu_ch">'. $donnes .'</textarea></fieldset>
			 
			 <input type="submit" class="submit" value="تعديل الفصل" name="modif_chapt" />
			 <input type="reset" class="submit" name = "Effacer" value = "حذف"/>
			 </form>';
			 
             }
			 $q->CloseCursor();
		     return;
		 }
	
	}
	 if(isset($_GET['ap']) )
	{
	        $id = $_GET['ap']; 
			$haut =		htmlspecialchars($_GET['h']);
            		
	        if($haut!= $_SESSION['pseudo']){
                echo'غير ممكن';
	            header('Location: .');
                exit();
	         }
			else
            { 
			   if(isset($_POST['ajouter']))
	            {
				  $part =new partie(array(  'titre'   => $_POST['part'],  
                                 		    'cour'    =>$id,
											'hauteur' =>$_SESSION['pseudo']));
	              
				  $coura->ajouter_p($part);
				  echo'تم تعديل الجزء بنجاح';
				  $lien='index_cour.php?e='.$part->cour().'&h='.$_SESSION['pseudo'];
				  echo'<p><a href="'.$lien.'">اضغط هنا للرجوع للوراء</a></p>';
	            }
				else
				{
				$lien=isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : 'mes_tuto.html';
			   echo'<form action="" method="post"><fieldset><label for="titre">العنوان</label><input type="text" id="titre" name="part"/>
			   </fieldset><input type="submit"  class="submit" value="اضافة جزء" name="ajouter" />
			   </form>
			       <p><a href="'.$lien.'">اضغط هنا للرجوع للوراء </a></p>';
				   
			    }
				return;
			}			
	
	
	
	}
    if(isset($_GET['ach']) )
	{
	        $partie = $_GET['ach']; 
			$haut=htmlspecialchars($_GET['h']);
			$cour=htmlspecialchars($_GET['co']);
			
	        if($haut!= $_SESSION['pseudo']){
                echo'غير ممكن';
	            header('Location: .');
                exit();
	         }
             else
            { 
			   if(isset($_POST['ajouter_c']))
	            {
				  $chapitre=htmlspecialchars($_POST['chapt']);
				  if(!empty($chapitre)){
	              $chapt= new chapitre(array('titre'     =>$chapitre,
				                              'partie'   =>$partie,
											  'cour'     =>$cour,
											  'hauteur'  =>$haut)) ;
				  $coura->ajouter_ch($chapt);
				  echo'تم اضافة الفصل بنجاح';
				  $lien='index_cour.php?e='.$chapt->cour().'&h='.$_SESSION['pseudo'];
				  echo'<p> اضغط  <a href="'.$lien.'">هنا </a> للرجوع الى صفحة الدروس </p>';
				  }else{
				   echo'القصل فارغ';
				  }
			      
				  
	            }
				else
				{
				$lien=isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : 'mes_tuto.html';
			    echo'<form action="" method="post"><fieldset><label for="chapt">العنوان</label>
			    <input type="text" id="titre" name="chapt"/><input type="submit" class="submit" value="إنشاء فصل" name="ajouter_c" /></fieldset>
			    <input type="hidden" name="lien" value="'.$lien.'"/>
			    </form>
			    <p><a href="'.$lien.'">اضغط هنا للرجوع للوراء </a></p>';
				}
				return;
			}			
	

    }
    if(isset($_GET['ren_p']) )
	{
	     	$partie = (int)$_GET['ren_p'];
			$cour   = (int)$_GET['co'];
            $haut  =   htmlspecialchars($_GET['h']);	
			
	        if($haut!= $_SESSION['pseudo'] || $coura->part_existe($partie,$haut) ==false){
                echo'غير ممكن';
	            header('Location: .');
                exit();
	         }
			 else
			 {
			   if(isset($_POST['rennomer_p']))
	            {
				  
	             $part =new partie(array(   'id'      =>$partie,
				                            'titre'   => $_POST['n_part'],  
                                 		    'cour'    =>$cour,
											'hauteur' =>$_SESSION['pseudo']));
				  $coura->update_p($part);
				  echo'تمت اعادة تسمية الجزء بنجاح';
				  $lien='index_cour.php?e='.$part->cour().'&h='.$_SESSION['pseudo'];
				  echo'<p><a href="'.$lien.'">اضغط هنا للرجوع الى صفحة الدروس</a></p>';
	            }
				else
				{
			   echo'<form action="" method="post"><fieldset><label for="n_part">titre</label><input type="text" id="titre" name="n_part"/><input type="submit" class="submit" value="اعادة تسمية الجزء" name="rennomer_p" /></fieldset></form>';
			    }
				return;			     
			 
			 }
	
	}	
    if(isset($_GET['sup_p']) )
	{
		     	$partie = (int)$_GET['sup_p']; 
				$cour =(int)$_GET['co'];
				$haut =	htmlspecialchars($_GET['h']);	
	            if($haut!= $_SESSION['pseudo'] || $coura->part_existe($partie,$haut) ==false){
                echo'غير ممكن';
	            header('Location: .');
                exit();
				}else
				{ 
	             $part =new partie(array(   'id'      =>$partie,
                                 		    'cour'    =>$cour,
											'hauteur' =>$_SESSION['pseudo']));
				  $coura->delete_paritie($part);
				  $lien='index_cour.php?e='.$part->cour().'&h='.$_SESSION['pseudo'];
				  echo'<p><a href="'.$lien.'">اضغط هنا للرجوع للوراء</a></p>';
				  
				
				}
				return;
	     
	}
	if(isset($_GET['vde']) )
	{
		$id = (int)$_GET['vde']; 
		$haut =	htmlspecialchars($_GET['h']);
		
	       if($_GET['h']!= $_SESSION['pseudo'] || $coura->cour_existe($id,$haut)==false)
		    {
                echo'غير ممكن';
	            header('Location: .');
                exit();
	        }
			else
			{
			    $cour =new cour(array('id'     => htmlspecialchars($id),
		                              'hauteur'   => htmlspecialchars($_SESSION['pseudo']) ));	
				
				$coura->valider($cour);
				$lien=isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : 'mes_tuto.html';
				echo'<p>شكرا على مشاركتك ,<br/>سيتم معاينة هدا الدرس من طرف الإدراة و سيتم عرضه عما قريب<br/><a href="'.$lien.'">اضغط هنا</a></p> ';
				
				
				return;
				
			
			}
			
	
	
	}
		if(isset($_GET['dvde']) )
	{
		$id = (int)$_GET['dvde']; 
		$haut =	htmlspecialchars($_GET['h']); 
	       if($_GET['h']!= $_SESSION['pseudo'])
		    {
                echo'غير ممكن';
	            header('Location: .');
                exit();
	        }
			else
			{
			    $cour =new cour(array('id'     => htmlspecialchars($id),
		                              'hauteur'   => htmlspecialchars($_SESSION['pseudo']) ));

				$coura->Devalider($cour);
				$lien=isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : 'mes_tuto.html';
				echo'<p>تم تعطيل الدرس <br/><a href="'.$lien.'">اضغط هنا</a></p> ';
				
				
				return;
				
			
			}
			
	
	
	}
	
?>
          <h2>إضافة درس جديد</h2>
          <form action="index_cour.php" method="post" enctype="multipart/form-data">
		  <fieldset>
		      <p>
			     <label for="titre">عنوان</label><input type="text"  name="titre"/><br/>
				 <label for="intro">مقدمة</label><textarea name="intro" rows="8" cols="45"></textarea><br/>
				 <label for="conclusion">الخاتمة</label><textarea name="conclusion"  rows="8" cols="45"></textarea><br/>
				 <label for="type">نوع</label>
				 <select name="type" >
                    <option value="prog">برمحة</option>
                    <option value="progweb">برمجة الويب</option>
                    <option value="infog">جرافيك</option>
					<option value="autre">آخر</option>
                 </select><br/>
				 <label for="lge" >لغة البرجة </label><input type="text"  name="lge"/><br/>
				 <label for="icone">صورة: </label><input type="file" name="icone"  />(Taille max : 50Ko )<br/><br/>
			     <input type="submit" class="submit" value="إنشاء هذا الدرس" name="creer" />
				  
			  </p>
		  
		  </fieldset>	  
		  </form>

		  <?php
	      $cour =new cour(array('hauteur'   => htmlspecialchars($_SESSION['pseudo']) ));
		  $donnes = $coura->getlist($cour);
		  $retour=$cour->affichage($donnes,$cour);
		  $retour2= '<table><tr> <th>صورة</th>   <th>   عنوان   </th><th>    نوع   </th><th>   لغة البرجة     </th><th>   تاريخ الإنشاء    </th><th>  تاريخ آخر تعديل </th> <th></th><th></th><th></th><th></th><th></th>  </tr>';
		  if($retour==$retour2)
		  {
		    $retour='لاتمك دروس حاليا';
		  }
		  echo $retour;?>           	 
		  <script type="text/javascript">
	     var bbb = document.getElementById('bbb').addEventListener('click', function() {
         if(!confirm('etes vous sur de vouloir supprimer se cour')){this.href='';}
         }, false);

		  
	     </script><?php
		  return $retour;
		  
		  ?>

		  </div>

    </body>
</html>


