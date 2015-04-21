<html><head><link rel="stylesheet" media="screen" type="text/css" title="Design" href="../design.css" /></head><body>
<?php 
session_start();
function chargerClasse($classname)
    {
        require $classname.'.class.php';
    }
    
    spl_autoload_register('chargerClasse');
	
include("../includes/identifiants.php");
include("../includes/debut.php");
	include_once("../cour.class.php");
	include_once("../partie.class.php");
	include_once("../chapitre.class.php");
	include("../includes/mcode.php");

if (!verif_auth(ADMIN))  erreur("<h1>vous etes pas mon admisnitrateur</h1>");
	
	try
    {
	$db = new PDO('mysql:host=localhost;dbname=forum', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
	$admin = new adminCour($db);
	$donnes =array();
	$donnes =$admin->getList();
    $retour= '<table><tr> <th>icone</th>   <th>   titre   </th><th>    type   </th><th>   lanquage    </th><th>   time_creation   </th><th>  time_update</th> <th></th><th></th><th></th><th></th><th></th>  </tr>';

	    foreach($donnes as $key=>$val)
	    { 
		        if(!empty($val['icone'])){
			                $retour= ''.$retour. '<tr>
							<td><img src="../images/icone/'.htmlspecialchars($val['icone']).'" alt="membre  " /></td>';
							}
							else{
							$retour= ''.$retour. '<tr>
							<td><img src="../images/icone/icone3.png" alt="membre  " /></td>';
							}
							$retour= ''.$retour. '
							<td>  <strong>'.$val['titre'].'</strong>  </td>
							<td>  '.htmlspecialchars($val['type']).'  </td><td>  '.htmlspecialchars($val['lge']).'  </td>
							<td>  '.date('H\hi \l\e d/M/Y',htmlspecialchars($val['time_creation'])).'  </td>
							<td>  '.date('H\hi \l\e d/M/Y',htmlspecialchars($val['time_update'])).'  </td>
							';
							if($val['valid']==1){
							$retour= ''.$retour. '<td><a href="admin_cour.php?vde='.htmlspecialchars($val['id']).'&h='.htmlspecialchars($val['hauteur']).'">Valider</a></td>';
							}else
							{
							$retour= ''.$retour. '<td><a href="admin_cour.php?dvde='.$val['id'].'">Dévalider</a></td>';
							}
							$retour= ''.$retour. '<td> <a href="admin_cour.php?t='.htmlspecialchars($val['id']).'"> modifier </a> </td>
							<td><a href="admin_cour.php?s='.htmlspecialchars($val['id']).'">supprimer</a></td>
							<td><a href="admin_cour.php?v='.$val['id'].'">afficher</a></td></tr>';
		}
		echo($retour);
		
	if(isset($_GET['vde']) )
	{
		$id = (int)$_GET['vde']; 
		$haut =	htmlspecialchars($_GET['h']);
		

			    $cour =new cour(array('id'     => htmlspecialchars($id) ));	
				
				$admin->valider($cour);
				
				
				return;
				
			
			
	}
	if(isset($_GET['dvde']) )
	{
		$id = (int)$_GET['dvde']; 
		
		

			    $cour =new cour(array('id'     => htmlspecialchars($id) ));	
				
				$admin->devalider($cour);
				
				
				return;
				
			
			
	}
		if(isset($_GET['t']) )
	{
	/*
	--------------------------------modifier un cour ----------------------------------------------------
	*/
	     $id = (int)$_GET['t'];
		 
           	if(isset($_POST['modif']))
	        {
					    $cour =new cour(array('id' =>htmlspecialchars($id),
						          'titre'     => htmlspecialchars($_POST['titre']),
			                      'intro'     => htmlspecialchars($_POST['intro']),
								  'conclusion'=> htmlspecialchars($_POST['conclusion']),
								  'type'      => htmlspecialchars($_POST['type']),
								  'lge'       => htmlspecialchars($_POST['lge']) ));
		        $admin->update($cour);		
                         			
			
			
			
			      return ;
			}else{
	      $cour =new cour(array('id'     => htmlspecialchars($id)));				
			$donnes = $admin->getcour($cour);
			
			
			foreach($donnes as $key=>$val)
			  {
			     echo '<form action="" method="post">
		         <fieldset>
		         <p>
			     <label for="titre">titre</label><input type="text" id="titre" name="titre" value="'.$val['titre'].'" /><br/>
				 <label for="intro">intro</label><textarea name="intro" id="intro" rows="8" cols="45">'.$val['intro'].'</textarea><br/>
				 <label for="conclusion">conclusion</label><textarea name="conclusion" id="conclusion" rows="8" cols="45">'.$val['conclusion'].'</textarea><br/>
				 type:   
				 <select name="type">
                    <option value="prog">programmation</option>
                    <option value="progweb">programmation web</option>
                    <option value="infog">infographie</option>
					<option value="autre">autre</option>
                 </select><br/>
				 <label for="lge">language</label><input type="text" id="lge" name="lge" value="'.$val['lge'].'"/><br/>
				  <label for="icone">Avatar: </label><input type="file" name="icone" id="icone" />(Taille max : 50Ko (100px X 100px))<br/>
			      <input type="submit" class="submit" value="modifier ce cour" name="modif" />
				  
			     </p>
		  
		         </fieldset>	  
		          </form>';
			  
			   }
			return $donnes;
	    }
	
	}
		 if(isset($_GET['v']) )
	{    
	/*
	------------------------------------afficher un cour -------------------------------------------------------------
	*/
	     $partie = array();
	     $id = $_GET['v'];
		 
		 $intro='';$conc='';$type='';$lge;$tm_cr;$tm_upd;
		 

		  $message='';
	      $cour =new cour(array('id'     => $id ));
		  $donnes =$admin->getcour($cour);
		  $donnes2 =$admin->countpartie($cour);
		  
		   if($donnes2['nbp'] != 0)
			{
		         $donnes3=$admin->getpartie($cour);
				 foreach($donnes3 as $key=>$val)
			        {
					     
						 $part[]= $val['id'];
						 $titre_p[]= $val['titre'];
                         				 
				    }
		         
		  
		    }
			else
			{
			     $message ='ce cour ne contitient aucun partie';
			}
		           foreach($donnes as $key=>$val)
			        {
					     $intro =$val['intro'];
                         $conc  =$val['conclusion']	;
						 $titre=$val['titre']	;
                         						 
				    }

		  $contenu='<div id="intro_c">
                    <div id="t_cour">  
					<h1 style="color:#8096c8;">'.$titre.'</h1>
					<p>'.$intro.'</p>
					</div>
					</div>
					
					<div id="cour">
                    <p>
                    <hr/></p>
                    <ul id="sommaire">
                    <h2>somaire</h2>';
					
					for($i=0; $i<$donnes2['nbp'];$i++)
                    {     
					     $titre2 =array();
					      $partie =new partie(array('id'      =>$part[$i],
						                           'titre'   =>$titre_p[$i],
						                           'cour'    =>$id));
						 $nbrch =$admin->countchapitre($partie);
						 
					     $contenu=''.$contenu.' <h3>'.$partie->titre().'</h3>';
						 
						      if($nbrch[0]!=0)
						    {
							     $contenu=''.$contenu.' <ol>';
							     $chapitre2 =$admin->getchapitre($partie);
								 		foreach($chapitre2 as $key=>$val)
			                            {
					                       
                                           $titre2[]  =$val['titre'];
                                           $id_ch[]	  =$val['id']	;										   				 
				                        }
										
										for($c=0; $c<$nbrch[0];$c++)
                                        { 
										    $contenu =''.$contenu.'<li><a href="admin_cour.php?affich_ch='.$id_ch[$c].'&p='.$partie->id().'&co='.$partie->cour().'"">'.$titre2[$c].'</a></li>';				 
										} 
										$contenu=''.$contenu.' </ol>';
										
								 
							}
					     
					 			
					
					
					
		  echo($contenu);
		  return ;
	
	    }
	}
		 if(isset($_GET['affich_ch']) )
	{	
	     $chapitre_supp = $_GET['affich_ch'];
		 $cour =$_GET['co'];
		 $part =$_GET['p'];
		 

		    $chapitre = new chapitre(array('id'    =>$chapitre_supp,
										    'partie'=>$part,
									        'cour'  =>$cour   ));
            
			
			$affich= $admin->get_chapt($chapitre);
			echo zcode('<div id="corp">'.$affich.'</div>') ;
	   return;
	    
	}
	     if(isset($_GET['s']) )
	{
	 /*
	 ------------------------------------------------------supprimer un cour --------------------------------------------------
	
	 */
	     $id = (int)$_GET['s'];
		 

	      $cour =new cour(array('id'     => htmlspecialchars($id) ));
		  $admin->delcour($cour);
		  $donnes = $admin->getlist($cour);


		  return ;
			 
	    
	
	}
	
?>
</body></html>