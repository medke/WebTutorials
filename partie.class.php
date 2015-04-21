<?php
class partie 
{

private $id,
        $titre,
		$cour,
		$hauteur;
		
     public function __construct(array $donnes)
	    {
	    $this->hydrate($donnes);
	    }
		
	public function hydrate(array $donnes)
	{       
	     foreach($donnes as $key=>$val)
		{
		    switch($key)
			{
			    case 'id':
				case 'cour':
				     $this->$key =(int) $val;
					 break;
				case 'titre':
				case 'hauteur':
				     $this->$key =(string)  stripslashes($val);
					 break;				 
			
			}
		}
	
	}

	 public function titre()
	   {
          return $this->titre;	   
	   }
	  public function id()
	   {
          return $this->id;	   
	   }
	 public function cour()
	   {
          return $this->cour;	   
	   }
	 public function hauteur()
	   {
          return $this->hauteur;	   
	   }
		

}
?>