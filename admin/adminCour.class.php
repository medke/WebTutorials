<?php
class adminCour
{
 private $db,$error_m;
	
	
	 public function __construct($db)
	 {
	     $this->db =$db;
	 }
	 public function error_m()
	 {
	     return $this->error_m ;
	 }
	 public function getList()
	 {
	     $donnes=array();
	     $q =$this->db->query('SELECT id,titre,type,lge,time_creation,time_update,icone,hauteur,valid FROM cour WHERE valid>=1');
		 $donnes =$q->fetchAll();
		 return $donnes; 
	 
	 }
	 public function valider(cour $cour)
	 {
	   	$q =$this->db->prepare('UPDATE cour SET valid = 2 WHERE id=:id  ') ;
	    $q->bindValue(':id'        ,$cour->id(),PDO::PARAM_INT);
	
		$q->execute();
	    $q->CloseCursor();	 
	 }
	 public function devalider(cour $cour)
	 {
	   	$q =$this->db->prepare('UPDATE cour SET valid = 1 WHERE id=:id  ') ;
	    $q->bindValue(':id'        ,$cour->id(),PDO::PARAM_INT);
	
		$q->execute();
	    $q->CloseCursor();	 
	 }
	 public function getcour(cour $cour)
	 {
	     
	     $q =$this->db->query('SELECT titre,intro,conclusion,type,lge,time_creation,time_update  FROM cour WHERE  id="'.$cour->id().'"');
		 $donnes =$q->fetchAll();
		 return $donnes;
		 
	     $q->CloseCursor();
	 
	 
	 }
	 	public function update(cour $cour)
	 {   
	     $q =$this->db->prepare('UPDATE cour SET titre = :titre ,intro= :intro ,conclusion = :conclusion,type= :type ,lge= :lge
		                         WHERE id="'.$cour->id().'"  ') ;
		 $q->bindValue(':titre'     ,$cour->titre(),PDO::PARAM_STR);
		 $q->bindValue(':intro'     ,$cour->intro(),PDO::PARAM_STR);
		 $q->bindValue(':conclusion',$cour->conclusion(),PDO::PARAM_STR);
		 $q->bindValue(':type'      ,$cour->type(),PDO::PARAM_STR);
		 $q->bindValue(':lge'       ,$cour->lge(),PDO::PARAM_STR);
		 
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
	 	public function get_chapt(chapitre $chapitre)
	 {
	     $q =$this->db->query('SELECT contenu  FROM chapitre  WHERE id="'.$chapitre->id().'" AND cour="'.$chapitre->cour().'" AND partie="'.$chapitre->partie().'" ');
	     $donnes =$q->fetch();
		 return $donnes['contenu'];
		 
	     $q->CloseCursor();
	 
	 }
	  public function countchapitre(partie $partie)
	 {
	     $q =$this->db->query('SELECT COUNT(*) AS nbch
                               FROM chapitre c
                               INNER JOIN sous_partie p ON p.id = c.partie
							   INNER JOIN cour r ON r.id = c.cour
							   WHERE c.partie="'.$partie->id().'"
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
	 public function delcour(cour $cour)
	 {
	      $q =$this->db->exec('DELETE FROM cour WHERE  id="'.$cour->id().'"');
		  $q =$this->db->exec('DELETE FROM sous_partie WHERE cour="'.$cour->id().'"');
		  $q =$this->db->exec('DELETE FROM chapitre WHERE  cour="'.$cour->id().'"');
		  
	    
	 }
}
?>