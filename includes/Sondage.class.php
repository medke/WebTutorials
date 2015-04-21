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
		$this->$db=$bdd;
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
?>