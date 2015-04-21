<?php
class chapitre
{
 private $id,
         $titre,
         $contenu,
		 $partie,
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
				case 'partie':
				     $this->$key =(int) $val;
					 break;
				case 'titre':
				case 'contenu':
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
	   	 public function partie()
	   {
          return $this->partie;	   
	   }
	   	 public function id()
	   {
          return $this->id;	   
	   }
	   	 public function contenu()
	   {
          return $this->contenu;	   
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