<?php
class courManager {
    private $db,$error_m;
	
	
	 public function __construct($db)
	 {
	     $this->db =$db;
	 }
	 public function error_m()
	 {
	     return $this->error_m ;
	 }
     public function add(cour $cour)
	 {
	     $q =$this->db->prepare('INSERT INTO cour SET titre = :titre,intro= :intro ,conclusion = :conclusion,type= :type ,hauteur= :hauteur,lge= :lge,time_creation = :time_creation,time_update= :time_update') ;
		 $q->bindValue(':titre'     ,$cour->titre(),PDO::PARAM_STR);
		 $q->bindValue(':intro'     ,$cour->intro(),PDO::PARAM_STR);
		 $q->bindValue(':conclusion',$cour->conclusion(),PDO::PARAM_STR);
		 $q->bindValue(':type'      ,$cour->type(),PDO::PARAM_STR);
		 $q->bindValue(':hauteur'   ,$cour->hauteur(),PDO::PARAM_STR);
		 $q->bindValue(':lge'       ,$cour->lge(),PDO::PARAM_STR);
		 $q->bindValue(':time_creation',time(),PDO::PARAM_INT);
		 $q->bindValue(':time_update',time(),PDO::PARAM_INT);
		 $q->execute();
	
		 $q->CloseCursor();
		 $cour->setid($this->db->lastInsertId());
	 
	 }
	 public function getlist(cour $cour)
	 {
	     $donnes=array();
	     $q =$this->db->query('SELECT id,titre,type,lge,time_creation,time_update,valid,icone FROM cour WHERE hauteur="'.$cour->hauteur().'"');
		 $donnes =$q->fetchAll();
		 return $donnes;
		 
	     $q->CloseCursor();
	 }
	 public function getcour(cour $cour)
	 {
	     
	     $q =$this->db->query('SELECT titre,intro,conclusion,type,lge,time_creation,time_update  FROM cour WHERE hauteur="'.$cour->hauteur().'" AND id="'.$cour->id().'"');
		 $donnes =$q->fetchAll();
		 return $donnes;
		 
	     $q->CloseCursor();
	 
	 
	 }
	 	 public function delcour(cour $cour)
	 {
	      $q =$this->db->exec('DELETE FROM cour WHERE hauteur="'.$cour->hauteur().'" AND id="'.$cour->id().'"');
		  $q =$this->db->exec('DELETE FROM sous_partie WHERE cour="'.$cour->id().'"');
		  $q =$this->db->exec('DELETE FROM chapitre WHERE  cour="'.$cour->id().'"');
		  
	    
	 }
	 
	 public function isValid(cour $cour)
	 {
	     $i=0;
	     $q =$this->db->query('SELECT titre FROM cour WHERE hauteur="'.$cour->hauteur().'"');
		 $donnes =$q->fetchAll();
		     foreach($donnes as $key=>$val)
		    {
		         if($val['titre']== $cour->titre())
				 {
				     $i+=1;
				 }
				 
				
		    }
			if($i!=0){
                 return false;			
			}
			else
			{
			     return true;
			}
		  $q->CloseCursor();

	 }

	 public function update(cour $cour)
	 {   
	     $q =$this->db->prepare('UPDATE cour SET titre = :titre ,intro= :intro ,conclusion = :conclusion,type= :type ,hauteur= :hauteur,lge= :lge,time_update = :time_update 
		                         WHERE titre="'.$cour->titre().'" AND hauteur="'.$cour->hauteur().'" ') ;
		 $q->bindValue(':titre'     ,$cour->titre(),PDO::PARAM_STR);
		 $q->bindValue(':intro'     ,$cour->intro(),PDO::PARAM_STR);
		 $q->bindValue(':conclusion',$cour->conclusion(),PDO::PARAM_STR);
		 $q->bindValue(':type'      ,$cour->type(),PDO::PARAM_STR);
		 $q->bindValue(':hauteur'   ,$cour->hauteur(),PDO::PARAM_STR);
		 $q->bindValue(':lge'       ,$cour->lge(),PDO::PARAM_STR);
		 $q->bindValue(':time_update',time(),PDO::PARAM_INT);
		 $q->execute();
	     $q->CloseCursor();
		 
	 }
	 public function countpartie(cour $cour)
	 {
	     $q =$this->db->query('SELECT COUNT(*) AS nbp
                               FROM sous_partie p
                               INNER JOIN cour c
                               ON c.id = p.cour
							   WHERE p.cour="'.$cour->id().'"
                               ');
		 $donnes = $q->fetch();
		 return $donnes;
	     $q->CloseCursor();
	 
	 }
	  public function countchapitre(partie $partie)
	 {
	     $q =$this->db->query('SELECT COUNT(*) AS nbch
                               FROM chapitre 
							   WHERE partie="'.$partie->id().'"
                               ');
		 $donnes = $q->fetch();
		 return $donnes;
	     $q->CloseCursor();
	 
	 }
	 	 public function getpartie(cour $cour)
	 {
	     $q =$this->db->query('SELECT id,titre  FROM sous_partie  WHERE cour="'.$cour->id().'"  ');
	     $donnes =$q->fetchAll();
		 return $donnes;
		 
	     $q->CloseCursor();
	 
	 }

	 public function getchapitre(partie $partie)
	 {
	     $q =$this->db->query('SELECT titre ,id,contenu  FROM chapitre  WHERE partie="'.$partie->id().'" AND cour="'.$partie->cour().'"  ');
	     $donnes =$q->fetchAll();
		 return $donnes;
		 
	     $q->CloseCursor();
	 
	 }
	public function get_chapt(chapitre $chapitre)
	 {
	     $q =$this->db->query('SELECT contenu  FROM chapitre  WHERE id="'.$chapitre->id().'" AND cour="'.$chapitre->cour().'" AND partie="'.$chapitre->partie().'" ');
	     $donnes =$q->fetch();
		 return $donnes['contenu'];
		 
	     $q->CloseCursor();
	 
	 }
	 public function ajouter_p(partie $partie)
	 {
	     $q =$this->db->prepare('INSERT INTO sous_partie SET titre = :titre,cour= :cour ,hauteur=:hauteur  ') ;
		 $q->bindValue(':titre'      ,$partie->titre()  ,PDO::PARAM_STR);
		 $q->bindValue(':cour'       ,$partie->cour()   ,PDO::PARAM_INT);
         $q->bindValue(':hauteur'     ,$partie->hauteur(),PDO::PARAM_STR);
		 $q->execute();
	
		 $q->CloseCursor();
	 
	 
	 }
	 public function ajouter_ch(chapitre $chapitre)
	 {
	     $q =$this->db->prepare('INSERT INTO chapitre SET titre = :titre,partie= :partie,cour =:cour,hauteur=:hauteur ') ;
		 $q->bindValue(':titre'      ,$chapitre->titre(),PDO::PARAM_STR);
		 $q->bindValue(':partie'     ,$chapitre->partie(),PDO::PARAM_STR);
		 $q->bindValue(':cour'       ,$chapitre->cour(),PDO::PARAM_STR);
		 $q->bindValue(':hauteur'     ,$chapitre->hauteur(),PDO::PARAM_STR);
		 $q->execute();
	
		 $q->CloseCursor();
	 
	 
	 }
	 public function update_p(partie $partie)
	 {
	     $q =$this->db->prepare('UPDATE sous_partie SET titre = :titre  
		                         WHERE id=:id AND cour= :cour') ;
		 $q->bindValue(':titre'     ,$partie->titre(),PDO::PARAM_STR);
		 $q->bindValue(':id'        ,$partie->id(),PDO::PARAM_INT);
		 $q->bindValue(':cour'      ,$partie->cour(),PDO::PARAM_INT);
		 $q->execute();
	     $q->CloseCursor();
					 
								 
	 
	 }
	 public function delete_paritie(partie $partie)
	 {
	     $q =$this->db->exec('DELETE FROM sous_partie WHERE id="'.$partie->id().'" AND cour="'.$partie->cour().'"');
		 $q =$this->db->exec('DELETE FROM chapitre WHERE partie="'.$partie->id().'" AND cour="'.$partie->cour().'"');
	 
	 
	 
	 }
	 public function  update_chapt(chapitre $chapitre)
	 {
	     $q =$this->db->prepare('UPDATE chapitre SET titre = :titre , contenu= :contenu 
		                         WHERE id= :id  AND partie= :partie AND cour= :cour') ;
		 $q->bindValue(':titre'       ,$chapitre->titre()  ,PDO::PARAM_STR);
		 $q->bindValue(':contenu'     ,$chapitre->contenu(),PDO::PARAM_STR);
		 $q->bindValue(':id'          ,$chapitre->id(),PDO::PARAM_INT);
		 $q->bindValue(':partie'      ,$chapitre->partie(),PDO::PARAM_INT);
		 $q->bindValue(':cour'        ,$chapitre->cour()  ,PDO::PARAM_INT);
		 $q->execute();
	     $q->CloseCursor();	     
	 
	 }
	 public function supprimer_chapt(chapitre $chapitre)
	 {
	     $q =$this->db->exec('DELETE FROM chapitre WHERE id="'.$chapitre->id().'" AND partie="'.$chapitre->partie().'" AND cour="'.$chapitre->cour().'" ');
	 
	 }
	 public function valider(cour $cour)
	 {
	   	$q =$this->db->prepare('UPDATE cour SET valid = 1 WHERE id=:id AND hauteur=:hauteur ') ;
	    $q->bindValue(':id'        ,$cour->id(),PDO::PARAM_INT);
		$q->bindValue(':hauteur'   ,$cour->hauteur(),PDO::PARAM_STR);
		$q->execute();
	    $q->CloseCursor();	 
	 }
	 public function Devalider(cour $cour)
	 {
	   	$q =$this->db->prepare('UPDATE cour SET valid = 0 WHERE id=:id AND hauteur=:hauteur ') ;
	    $q->bindValue(':id'     ,$cour->id(),PDO::PARAM_STR);
		$q->bindValue(':hauteur'   ,$cour->hauteur(),PDO::PARAM_STR);
		$q->execute();
	    $q->CloseCursor();	 
	 }
	 public function verif_avatar(array $file)
	{
	    $avatar_erreur= NULL;
	    $avatar_erreur1= NULL;
	    $avatar_erreur2= NULL;
		$avatar_erreur3= NULL;
	    

            //On définit les variables :
			$i=0;
            $maxsize = 30072; //Poid de l'image
            $maxwidth = 100; //Largeur de l'image
            $maxheight = 100; //Longueur de l'image
            //Liste des extensions valides
            $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' );
 
            if ($file['icone']['error'] > 0)
            {
                $avatar_erreur = "Erreur lors du tranfsert de l'icone : ";
            }
            if ($file['icone']['size'] > $maxsize)
            {
                $i++;
                $avatar_erreur1 = "Le fichier est trop gros :
                (<strong>".$file['icone']['size']." Octets</strong>
                contre <strong>".$maxsize." Octets</strong>)";
            }
 
            $image_sizes = getimagesize($file['icone']['tmp_name']);
            if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
            {
                $i++;
                $avatar_erreur2 = "Image trop large ou trop longue :
                (<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre
                <strong>".$maxwidth."x".$maxheight."</strong>)";
            }
 
            $extension_upload = strtolower(substr(  strrchr($file['icone']['name'], '.')  ,1));
            if (!in_array($extension_upload,$extensions_valides) )
            {
                $i++;
                $avatar_erreur3 = "Extension de l'icone incorrecte";
            }
		    if ($i == 0) // Si $i est vide, il n'y a pas d'erreur
            {
			     return true;
			}
			else
			{
			     $this->error_m = ' '.$this->error_m.' '.$i.'erreurs <br/>'.$avatar_erreur.'<br/>'.$avatar_erreur1.'<br/>'.$avatar_erreur2.'<br/>'.$avatar_erreur3;
			     return false;
				 
			}
	
	}
	public function update_avatar($nomavatar,cour $cour) 
	{
	    $query=$this->db->prepare('UPDATE cour
        SET icone = :icone
        WHERE titre = :titre');
        $query->bindValue(':icone',$nomavatar,PDO::PARAM_STR);
        $query->bindValue(':titre',$cour->titre(),PDO::PARAM_STR);
        $query->execute();
        $query->CloseCursor();
	}
	public function chapt_existe($id,$haut)
	 {
	    $q=$this->db->query('SELECT COUNT(*) FROM chapitre WHERE id="'.$id.'" AND hauteur ="'.$haut.'"')->fetchColumn();
		$n = (int)$q;
		if($n != 0){
		return true;
		}else{
		return false;
		}
	 }
	 public function part_existe($id,$haut)
	 {
	    
	    $q=$this->db->query('SELECT COUNT(*) FROM sous_partie WHERE id="'.$id.'" AND hauteur ="'.$haut.'"')->fetchColumn();
		$n = (int)$q;
		if($n != 0){
		return true;
		}else{
		return false;
		}
	 }
	 	 public function cour_existe($id,$haut)
	 {
	    
	    $q=$this->db->query('SELECT COUNT(*) FROM cour WHERE id="'.$id.'" AND hauteur ="'.$haut.'"')->fetchColumn();
		$n = (int)$q;
		if($n != 0){
		return true;
		}else{
		return false;
		}
	 }




}

?>