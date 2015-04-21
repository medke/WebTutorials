<?php
session_start();
function chargerClasse($classname)
    {
        require $classname.'.class.php';
    }
    
    spl_autoload_register('chargerClasse');
    
     // On appelle session_start() APR?S avoir enregistr? l'autoload
    $titre="الدروس";

    include("includes/identifiants.php");
    include("includes/debut.php");
    include("./includes/menu.php");
	include("./includes/mcode.php");
		
      $coura = new courManager($db);		
	if(isset($_GET['co']) && isset($_GET['c']))
	{
	       $id =(int)$_GET['c'];
	      $cour =new cour(array('id'     => $id));
		  $q =$db->query('SELECT titre,intro,conclusion,hauteur,type,lge,time_creation,time_update  FROM cour WHERE   id="'.$cour->id().'"');
		  $donnes =$q->fetch();

					     $intro =$donnes['intro'];
                         $conc  =$donnes['conclusion']	;
						 $titre=$donnes['titre']	;
						 $hauteur=$donnes['hauteur'];
			 $q->CloseCursor();
          $q =$db->query('SELECT membre_id,membre_avatar FROM forum_membres WHERE   membre_pseudo="'.$hauteur.'"');  	
           $data =$q->fetch();	
		   $id_redactor = $data['membre_id'];
		   $avatar_redactor = $data['membre_avatar'];
           $q->CloseCursor();
        		   
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
			     $message ='هدا الدرس لا يحتوي على أي جزء';
			}

			$lien=isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : 'mes_tuto.html';
			echo '<p><a href="'.$lien.'">الرجوع للوراء</a></p>
			<div class="info_redact">
			<h4 class="information">معلومات</h4>
			<div class="contenu">
			<p><img src="./images/avatars/'.htmlspecialchars($avatar_redactor).'" alt="membre" /><br/>الكاتب: <a href="./voirprofil.php?m='.htmlspecialchars($id_redactor).'" >'.htmlspecialchars($hauteur).'</a></p>
			</div>
			
			<div class="publicite">
			<h4 >إعلان</h4>
			<div class="pub"><p>لا يوجد إعلان حاليا</p></div>
			</div>
			</div>
			';
			
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
						                           'cour'    =>$id));
												   
						 $nbrch =$coura->countchapitre($partie);
						 
					     $contenu=''.$contenu.' <h3>'.$partie->titre().'</h3>';
						 
						      if($nbrch[0]!=0)
						    {
							     $contenu=''.$contenu.' <ol>';
							     $chapitre2 =$coura->getchapitre($partie);
								 		foreach($chapitre2 as $key=>$val)
			                            {
					                       
									   				 

										    $contenu =''.$contenu.'<li><a href="tuto.php?affich_ch='.$val['id'].'&p='.$partie->id().'&co='.$partie->cour().'"">'.$val['titre'].'</a></li>';				 
										} 
										$contenu=''.$contenu.' </ol>';
										
								 
							}
					     
					 				
					}
					
					
		  echo($contenu);
		 return;
	}
	if(isset($_GET['lge']))
	{
	    
	    $lge = (isset($_GET['lge'])) ? htmlspecialchars(stripslashes($_GET['lge'])) : '';
	
         if($lge=="all")
		 {
		   $q =$db->query('SELECT id,titre,type,lge,time_creation,time_update,valid,icone,hauteur FROM cour WHERE  valid=2');
		 }
		 else
		 {
	     $q =$db->query('SELECT id,titre,type,lge,time_creation,time_update,valid,icone,hauteur FROM cour WHERE lge="'.$lge.'" AND valid=2');
		 }
		 if ($q->rowCount()<1)
        {
		  $retour="<h4>لا يحتوي على دروس بعد.</h4>";
		}
		else
		{
		 $retour='<h3> دروس الــ '.$lge.'<br/></h3>';
		 $retour=''.$retour.'<table><tr><th>صورة</th><th class="titre">titre</th><th>بواسطة</th><th class="derniermessage">تاريخ الإنشاء</th> <th class="derniermessage">آخر تعديل</th></tr>';
         while($data = $q->fetch())
         {  
		     if(empty($data['icone'])) $data['icone']='./images/icone/icone3.png';
			 $time_creation=stripslashes(htmlspecialchars($data['time_creation']));
			 $time_update=stripslashes(htmlspecialchars($data['time_update']));
             $retour =''.$retour.'<tr><td><img src="'.stripslashes(htmlspecialchars($data['icone'])).'" alt="icone"/></td>
			 <td><a href="./tuto.php?co='.$data['titre'].'&c='.$data['id'].'">'.stripslashes(htmlspecialchars($data['titre'])).'</a></td>
			 ';
			 $hauteur=stripslashes(htmlspecialchars($data['hauteur']));
		     $qe =$db->query('SELECT membre_id,membre_avatar FROM forum_membres WHERE   membre_pseudo="'.$hauteur.'"');  	
             $d =$qe->fetch();	
			 $qe->CloseCursor();
		     $id_redactor = $d['membre_id'];
		     $avatar_redactor = $d['membre_avatar'];
			 $retour =''.$retour.'<td><a href="./voirprofil.php?m='.htmlspecialchars($id_redactor).'" >'.htmlspecialchars($hauteur).'</a></td>
			 <td>'.date('H\hi  d/M/Y',$time_creation).'</td>
			 <td>'.date('H\hi  d/M/Y',$time_update).'</td>
			 </tr>' ;

         }
		 $retour =''.$retour.'</table></div>';
		 $q->CloseCursor();
        }
	echo($retour);
	}
	if(isset($_GET['affich_ch']) && isset($_GET['co']) && isset($_GET['p']))
	{	
	     $chapitre_supp = $_GET['affich_ch'];
		 $cour =$_GET['co'];
		 $part =$_GET['p'];

		 

		    $chapitre = new chapitre(array('id'    =>$chapitre_supp,
										    'partie'=>$part,
									        'cour'  =>$cour  ));
            
			
			$affich= $coura->get_chapt($chapitre);
			$lien=isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : 'tuto.html';
			echo '<p><a href="'.$lien.'">الرجوع للوراء</a></p>';
			echo zcode('<div id="corp">'.$affich.'</div>') ;
	   return;
	    
	}
		  ?>
         
		  </div>

    </body>
</html>