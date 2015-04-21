<?php
class membre{

 private $membre_id ,
         $membre_pseudo,
         $membre_mdp,
		 $membre_mdp_conf,
         $membre_email,
		 $membre_msn,
		 $membre_siteweb,
		 $membre_signature,
		 $membre_localisation,
		 $membre_inscrit,
		 $membre_derniere_visite,
		 $membre_rang,
		 $membre_post,
		 $membre_bio,
		 $membre_ip;
 private $membre_avatar='';		 
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
			    case 'membre_id':
				case 'membre_inscrit':
				case 'membre_derniere_visite':
				case 'membre_rang':
				case 'membre_post':
				     $this->$key =(int) $val;
					 break;
				case 'membre_pseudo':
				case 'membre_email':
				case 'membre_msn':
				case 'membre_siteweb':
				case 'membre_avatar':
				case 'membre_signature':
				case 'membre_localisation':
				case 'membre_bio':
				case 'membre_ip':
				     $this->$key =(string) $val;
					 break;
				case 'membre_mdp':
				case 'membre_mdp_conf':
                     $this->$key =md5($val);
                     break;					 
			
			}
		}
	
	}
	public function getMembre_id()
	{
	     return $this->membre_id;
	}
	public function id($id)
    {
	    $this->membre_id = $id;
	}	
    public function getMembre_rang()
	{
	     return $this->membre_rang;
	}
	public function membre_rang($rang)
    {
	    $this->membre_rang = $rang;
	}
	
	public function getMembre_pseudo()
	{
	     return $this->membre_pseudo;
	}
    public function membre_pseudo($pseudo)
	{
	     $this->membre_pseudo =$pseudo ;
	}
	public function getMembre_mdp()
	{
	     return $this->membre_mdp;	
	}
	public function getMembre_mdp_conf()
	{
	     return $this->membre_mdp_conf;	
	}
	public function getMembre_email()
	{
	     return $this->membre_email;	
	}
    public function membre_email($email)
	{
	     $this->membre_email =$email;	
	}
	public function getMembre_msn()
	{
	     return $this->membre_msn;	
	}
	public function membre_msn($msn)
	{
	     $this->membre_msn =$msn;	
	}
	public function getMembre_siteweb()
	{
	     return $this->membre_siteweb;	
	}
	public function membre_siteweb($site)
	{
	     $this->membre_siteweb=$site;	
	}
	public function getMembre_signature()
	{
	     return $this->membre_signature;
	}
	public function membre_signature($sign)
	{
	     $this->membre_signature =$sign;
	}
	public function getMembre_localisation()
	{
	     return $this->membre_localisation;
	}
    public function membre_localisation($local)
	{
	     $this->membre_localisation=$local;
	}	
	public function getMembre_bio()
	{
	     return $this->membre_bio;	
	}
	public function membre_bio($bio)
	{
	     $this->membre_bio=$bio;	
	}
	public function getMembre_ip()
	{
	     return $this->membre_ip;	
	}
	public function getMembre_avatar()
	{
	     return $this->membre_avatar;	
	}
	public function membre_avatar($avatar)
	{
	     $this->membre_avatar =$avatar;	
	}
	public function getMembre_post()
	{
	      return $this->membre_post;
	}
	public function membre_post($post)
	{
	      $this->membre_post=$post;
	}
    public function getMembre_inscrit()
	{
	      return $this->membre_inscrit;
	}
	public function membre_inscrit($insc)
	{
	      $this->membre_inscrit=$insc;
	}


         

}
?>