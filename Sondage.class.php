<?php
class Sondage
{
 private $db,
         $id,
		 $titre,
		 $choix1,
		 $choix2,
		 $choix3,
		 $choix4,
		 $vote_id,
		 $vchoix1,
		 $vchoix2,
		 $vchoix3,
		 $vchoix4,
		 $tchoix;
		
	public function __construct(array $donnes,$bdd)
    {
	    $this->hydrate($donnes);
		$this->db=$bdd;
	}	 
	
	public function hydrate(array $donnes)
	{       
	     foreach($donnes as $key=>$val)
		{
		    switch($key)
			{
			    case 'id':
				case 'vote_id':
				case 'vchoix1':
				case 'vchoix2':
				case 'vchoix3':
			    case 'vchoix4':
				case 'tchoix':				
				     $this->$key =(int) $val;
					 break;
				case 'titre':
				case 'choix1':
				case 'choix2':
				case 'choix3':
				case 'choix4':
				$this->$key =(string) $val;
					 break;				 
			
			}
		}	 


    }
	public function getSondage()
	{
	    $query=$this->db->query('SELECT id,titre,choix1,choix2,choix3,choix4 FROM sondage ORDER BY id DESC');
        $data=$query->fetch();
		    if(htmlspecialchars($data['titre'])!='')
		    {
                 $this->choix1=htmlspecialchars($data['choix1']);
                 $this->choix2=htmlspecialchars($data['choix2']);
                 $this->choix3=htmlspecialchars($data['choix3']);
                 $this->choix4=htmlspecialchars($data['choix4']);
                 $this->titre=htmlspecialchars($data['titre']); 
		         $this->id =$data['id'];
		    }
		$query->CloseCursor();
	
	}
	public function getChoix1()
	{
	    return $this->choix1;
	}
	public function getChoix2()
	{
	    return $this->choix2;
	}
	public function getChoix3()
	{
	    return $this->choix3;
	}
	public function getChoix4()
	{
	    return $this->choix4;
	}
	public function getTitre()
	{
	    return $this->titre;
	}
	public function getId()
	{
	    return $this->id;
	}
}	
?>